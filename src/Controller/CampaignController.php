<?php

namespace App\Controller;

use App\Entity\Campaign;
use App\Entity\Participation;
use App\Entity\Payment;
use App\Form\CampaignType;
use App\Form\ParticipationType;
use App\Repository\CampaignRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/')]
final class CampaignController extends AbstractController
{

    #[Route(name: 'app_campaign_index', methods: ['GET'])]
    public function index(CampaignRepository $campaignRepository): Response
    {
        return $this->render('campaign/index.html.twig', [
            'campaigns' => $campaignRepository->findAll(),
            'top_campaigns' => $campaignRepository->findTopByGoal(4),
        ]);
    }



    #[Route('/campaign/new', name: 'app_campaign_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $campaign = new Campaign();
        $form = $this->createForm(CampaignType::class, $campaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $campaign->setUser($this->getUser());
            $entityManager->persist($campaign);
            $entityManager->flush();

            return $this->redirectToRoute('app_campaign_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('campaign/new.html.twig', [
            'campaign' => $campaign,
            'form' => $form,
        ]);
    }

    #[Route('/campaign/{id}', name: 'app_campaign_show', methods: ['GET'])]
    public function show(Campaign $campaign, CampaignRepository $campaignRepository): Response
    {
        return $this->render('campaign/show.html.twig', [
            'campaign' => $campaign,
            'top_donors' => $campaignRepository->findTopDonors($campaign, 3),
        ]);
    }

    #[Route('/campaign/{id}/payment', name: 'app_campaign_payment', methods: ['GET', 'POST'])]
    public function payment(Request $request, Campaign $campaign, EntityManagerInterface $entityManager): Response
    {

        $participation = new Participation();
        $participation->setCampaign($campaign);

        $payment = new Payment();
        $participation->setPayment($payment);
        $payment->setParticipation($participation);

        $form = $this->createForm(ParticipationType::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $participation->setUser($this->getUser());
            $entityManager->persist($participation);
            $entityManager->flush();

            return $this->redirectToRoute('app_campaign_show', ['id' => $campaign->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('payment/new.html.twig', [
            'campaign' => $campaign,
            'form' => $form,
        ]);
    }

    #[Route('/campaign/{id}/edit', name: 'app_campaign_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Campaign $campaign, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CampaignType::class, $campaign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_campaign_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('campaign/edit.html.twig', [
            'campaign' => $campaign,
            'form' => $form,
        ]);
    }

    #[Route('/campaign/{id}', name: 'app_campaign_delete', methods: ['POST'])]
    public function delete(Request $request, Campaign $campaign, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $campaign->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($campaign);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_campaign_index', [], Response::HTTP_SEE_OTHER);
    }
}

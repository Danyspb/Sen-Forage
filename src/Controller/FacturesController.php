<?php

namespace App\Controller;

use App\Entity\Consommation;
use App\Entity\Factures;
use App\Form\FactureTypesType;
use App\Repository\ConsommationRepository;
use App\Repository\FacturesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class FacturesController extends AbstractController
{
    /**
     * @Route("/factures", name="factures")
     */
    public function index(Request $request, EntityManagerInterface $manager, FacturesRepository $repo, ConsommationRepository $tab)
    {
        $info = $tab->findAll();
        $fac = $repo->findAll();
        $facture = new Factures();
        $form = $this->createForm(FactureTypesType::class, $facture);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {

            $t = $manager->getRepository(Consommation::class)->find($facture->getConsommation()->getId());
            $cns = $t->getLitreconsomme();
            $facture->setDatefacture(new \DateTime());
            $dtn = $facture->getDatefacture();
            $dtl = $dtn->add(new \DateInterval('P5D'));
            $facture->setDatelimitepaye($dtl);
            $prx = $t->getLitreconsomme() * $t->getPrix();
            $facture->setConsmensuelle((float)$cns);
            $facture->setPrix($prx);
            $manager->persist($facture);
            $manager->flush();

            return $this->redirectToRoute('factures');
        }

        return $this->render('factures/index.html.twig', [
            'form' => $form->createView(),
            'fac' => $fac,
            'info' => $info
        ]);
    }

    /**
     * @Route("/facture/delete{id}", name="facture_delete")
     *
     */
    public function delete($id,EntityManagerInterface $manager)
    {

        $facture = $manager->getRepository(Factures::class)->find($id);
        if ($facture != null ){
            $manager->remove($facture);
            $manager->flush();
        }
        return $this->redirectToRoute('factures');
    }



    /**
     * @Route("/facture/imprimer/{id}", name="imprimer_id")
     *
     */
    public function convertir($id,FacturesRepository $repo)
    {


        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $test = $repo->find($id);

        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('factures/pdf.html.twig', [
            'test' => $test
        ]);

        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => true
        ]);

    }
}

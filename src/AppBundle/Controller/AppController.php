<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Client;
use AppBundle\Entity\Rent;
use AppBundle\Entity\Vehicle;
use AppBundle\Form\ClientType;
use AppBundle\Form\RentType;
use AppBundle\Manager\ClientManager;
use AppBundle\Manager\DateManager;
use AppBundle\Manager\RentManager;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/")
 */
class AppController extends Controller
{

    /**
     * @Route("/index", name="index")
     */
    public function indexAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $session->clear();

        $rent = new Rent();
        $form = $this->createForm(new RentType(), $rent);
        $form->handleRequest($request);

        return $this->render('AppBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));

    }

    /**
     * @Route("/save-rent-init",name="save-rent-init")
     *
     */
    public function saveRentInitAction(Request $request)
    {

        $request = $this->getRequest();
        $session = $request->getSession();

        $rent = new Rent();

        $form = $this->createForm(new RentType(), $rent);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid() ) {
            /** @var RentManager $rentManager */
            $rentManager = $this->get('app.manager.rent');
            $rentManager->update($rent);

            if ($rent->getDateInit() <= $rent->getDateEnd()) {

                $rentManager->applyChanges();
                $session->set('rent_id', $rent->getId());

                /** @var \AppBundle\Manager\VehicleManager $manager */
                $manager = $this->get("app.manager.vehicle");
                /** @var ArrayCollection<Vehicle> $vehicles */
                $vehicles = $manager->findAvailableVehicles($rent);

                if (count($vehicles > 0)){
                    return $this->render('AppBundle:Default:vehicles.html.twig', array(
                        'vehicles' => $vehicles,
                    ));
                } else {
                    $this->addFlash(
                        'notice',
                        'No hay vehiculos disponibles para esta ciudad en estas fechas'
                    );
                    return $this->redirect($this->generateUrl('index'));
                }


            } else {

                $this->addFlash(
                    'notice',
                    'Fechas no válidas'
                );
                return $this->redirect($this->generateUrl('index'));

            }

        }


    }

    /**
     * @Route("/vehicle-ajax", name="select_vehicles", condition="request.headers.get('X-Requested-With') == 'XMLHttpRequest'")
     */
    public function vehiclesAction(Request $request)
    {
        $vehicle_id = $request->request->get('vehicle_id');
        $request = $this->getRequest();
        $session = $request->getSession();
        $session->set("vehicle_id", $vehicle_id);

        $msg = 'ok';

        return new JsonResponse($msg, 200);

    }

    /**
     * @Route("/client", name="client")
     */
    public function clientAction(Request $request)
    {

        $client = new Client();
        $form = $this->createForm(new ClientType(), $client);
        $form->handleRequest($request);

        return $this->render('AppBundle:Default:client.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/save-rent",name="save-rent")
     *
     */
    public function saveRentAction(Request $request)
    {

        $request = $this->getRequest();
        $session = $request->getSession();
        $rentId = $session->get('rent_id');
        $vehicleId = $session->get('vehicle_id');

        /** @var \AppBundle\Manager\RentManager $rentManager */
        $rentManager = $this->get("app.manager.rent");
        /** @var Rent $rent */
        $rent = $rentManager->findById($rentId);
        /** @var \AppBundle\Manager\VehicleManager $vehicleManager */
        $vehicleManager = $this->get("app.manager.vehicle");
        /** @var Vehicle $vehicle */
        $vehicle = $vehicleManager->findById($vehicleId);

        $client = new Client();
        $form = $this->createForm(new ClientType(), $client);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid() ) {
            /** @var ClientManager $clientManager */
            $clientManager = $this->get('app.manager.client');

            if (!$clientManager->isOver18($client)){
                $this->addFlash(
                    'notice',
                    'Debe ser mayor de edad'
                );
                return $this->redirect($this->generateUrl('client'));
            }

            $clientManager->update($client);

            $rent->setClient($client);
            $rent->setVehicle($vehicle);

            /** @var DateManager $dateManager */
            $dateManager = $this->get('app.manager.date');
            $duration = $dateManager->dateDifference($rent->getDateInit(), $rent->getDateEnd(), '%d');
            $rent->setCost($duration*($rent->getVehicle()->getCostPerDay()));
            $rentManager->update($rent);
            $clientManager->applyChanges();

            return $this->render('AppBundle:Default:resume.html.twig', array(
                'rent' => $rent,
            ));

        }

    }

    /**
     * @Route("/payment",name="payment")
     *
     */
    public function paymentAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $rentId = $session->get('rent_id');

        /** @var \AppBundle\Manager\RentManager $rentManager */
        $rentManager = $this->get("app.manager.rent");
        /** @var Rent $rent */
        $rent = $rentManager->findById($rentId);

        return $this->render('AppBundle:Default:payment.html.twig', array(
            'rent' => $rent,
        ));

    }

    /**
     * @Route("/thanks",name="thanks")
     *
     */
    public function thanksAction(Request $request)
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $rentId = $session->get('rent_id');

        /** @var \AppBundle\Manager\RentManager $rentManager */
        $rentManager = $this->get("app.manager.rent");
        /** @var Rent $rent */
        $rent = $rentManager->findById($rentId);
        $rent->setComplete(true);
        $rentManager->update($rent);
        $rentManager->applyChanges();

        return $this->render('AppBundle:Default:thanks.html.twig', array());

    }

}



<?php
namespace DrdPlus\Cave\UnitBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PersonController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DrdPlusCaveUnitBundle:Default:index.html.twig', array('name' => $name));
    }
}

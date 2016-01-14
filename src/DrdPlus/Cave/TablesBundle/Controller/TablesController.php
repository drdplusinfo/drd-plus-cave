<?php
namespace DrdPlus\Cave\TablesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TablesController extends Controller
{
    public function indexAction()
    {
        $tables = $this->container->get('drd_plus_cave_tables.tables');

        return $this->render('DrdPlusCaveTablesBundle:Default:index.html.twig', ['tables' => $tables]);
    }
}

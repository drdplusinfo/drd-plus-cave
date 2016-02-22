<?php
namespace DrdPlus\Cave\TablesBundle\Controller;

use DrdPlus\Tables\Table;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TablesController extends Controller
{
    public function indexAction()
    {
        $tables = $this->container->get('drd_plus_cave_tables.tables');
        $tablesAsArray = [];
        /** @var Table $table */
        foreach ($tables as $table) {
            $tableName = $this->parseTableName($table);
            $header = $this->humanize($table->getHeader());
            $values = $table->getValues();

            $tablesAsArray[] = ['values' => $values, 'header' => $header, 'name' => $tableName];
        }

        return $this->render('DrdPlusCaveTablesBundle:Default:index.html.twig', ['tables' => $tablesAsArray]);
    }

    private function parseTableName(Table $table)
    {
        preg_match('~(?<baseName>\w+)$~', get_class($table), $baseNameMatches);
        preg_match_all('~(?<parts>[A-Z][a-z]+)~', $baseNameMatches['baseName'], $partsMatches);
        $concatenated = implode(' ', $partsMatches['parts']);
        $name = ucfirst(strtolower($concatenated));

        return $name;
    }

    private function humanize(array $values)
    {
        return array_map(function ($value) {
            if (is_array($value)) {
                return $this->humanize($value);
            }

            return str_replace('_', ' ', $value);
        }, $values);
    }
}

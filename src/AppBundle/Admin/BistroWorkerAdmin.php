<?php
/**
 * Created by PhpStorm.
 * User: developer-01
 * Date: 8/25/16
 * Time: 11:29 AM
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Bistro;
use Sonata\AdminBundle\Admin\AbstractAdmin as Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class BistroWorkerAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        // get drivers whose not hav a car
//        $drivers = $em->getRepository('AppBundle:User')->findDriversWithCar('ROLE_DRIVER');

        $formMapper
                ->with('Main', array(
                    'class'       => 'col-md-9',
                    'box_class'   => 'box box-solid box-danger',
                    'description' => 'Lorem ipsum',
                    // ...
                ))
                    ->add('bistro', 'sonata_type_model_autocomplete',
                        array('property' => 'name', 'multiple'=>false,
                            "placeholder" => "Select a Driver ",
                            'attr'=>['style' => 'width: 300px !important'])
                    )
                    ->add('worker', 'sonata_type_model_autocomplete',
                        array('property' => 'username', 'multiple'=>false,
                            "placeholder" => "Select a Driver ",
                            'attr'=>['style' => 'width: 300px !important'])
                    )
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('bistro')
            ->add('created')
            ->add('updated')
        ;
    }

//    public function add(
//        $name,
//
//        // filter
//        $type = null,
//        array $filterOptions = array(),
//
//        // field
//        $fieldType = null,
//        $fieldOptions = null
//    )

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('bistro.name')
            ->add('worker.username')
            ->add('created')
            ->add('updated')
        ;
    }

}
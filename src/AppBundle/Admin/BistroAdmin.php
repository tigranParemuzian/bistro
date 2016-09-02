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

class BistroAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $em = $this->getConfigurationPool()->getContainer()->get('doctrine')->getManager();
        // get drivers whose not hav a car
//        $drivers = $em->getRepository('AppBundle:User')->findDriversWithCar('ROLE_DRIVER');

        $formMapper
            ->tab('Main')
                ->with('Main', array(
                    'class'       => 'col-md-9',
                    'box_class'   => 'box box-solid box-danger',
                    'description' => 'Lorem ipsum',
                    // ...
                ))
                    ->add('name', 'text')
                    ->add('number', 'number')
            ->add('file', 'add_file_type', array('required' => false, 'label'=>'Bistro image'))
            ->add('workers', 'sonata_type_collection', array(), array(
                'edit' => 'inline',
                'inline' => 'table',
                'sortable'  => 'id'
            ))
                ->end()
                ->with('Description', array('class' => 'col-md-3'))

                    ->add('description', 'textarea', array('required'=>false))
                ->end()
            ->end()
            ->tab('Parent')
                ->with('Parent', array('class' => 'col-md-12'))
                    ->add('address')
                    ->add('phone')
                   /* ->add('workers', 'sonata_type_model_autocomplete',
                        array('property' => 'username', 'multiple'=>true,

                            "placeholder" => "Select a Driver ",
                            'attr'=>['style' => 'width: 300px !important'])
                    )*/
                ->end()
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('number', null, array('show_filter' => true))
            ->add('description')
            ->add('address')
            ->add('phone')
            ->add('workers', null, array(), 'entity', array(
                'class'    => 'AppBundle\Entity\User',
                'property' => 'username',
            ))
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
            ->addIdentifier('name')
            ->addIdentifier('number')
            ->addIdentifier('description')
            ->addIdentifier('address')
            ->addIdentifier('phone')
            ->add('workers')
            ->add('created')
            ->add('updated')
            ->add('_action', 'actions', array(
                'actions' => array(
//                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($object)
    {
        if($object->getWorkers()){
            foreach($object->getWorkers() as $productIngredient) {
                $productIngredient->setBistro($object);
            }
        }

        $object->uploadFile();
    }
    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        if($object->getWorkers()){
            foreach($object->getWorkers() as $productIngredient) {
                $productIngredient->setBistro($object);
            }
        }

        $object->uploadFile();
    }
}
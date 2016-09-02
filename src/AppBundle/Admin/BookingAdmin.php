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

class BookingAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('Main', array(
                'class'       => 'col-md-9',
                'box_class'   => 'box box-solid box-danger',
                'description' => 'Lorem ipsum',
            ))
                ->add('count', 'text')
                ->add('cache', 'number')
            ->add('product')
            ->add('worker')
                ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('count')
            ->add('cache')
            ->add('product', null, array(), 'entity', array(
                'class'    => 'AppBundle\Entity\ProductIngredient',
                'property' => 'product',
            ))->add('worker', null, array(), 'entity', array(
                'class'    => 'AppBundle\Entity\BistroWorker',
                'property' => 'bistro',
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
            ->addIdentifier('count')
            ->addIdentifier('cache')
            ->add('product')
            ->add('worker')
            ->add('created')
            ->add('updated')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

//    /**
//     * {@inheritdoc}
//     */
//    public function preUpdate($object)
//    {
//        if($object->getWorkers()){
//            foreach($object->getWorkers() as $productIngredient) {
//                $productIngredient->setBistro($object);
//            }
//        }
//
//        $object->uploadFile();
//    }
//    /**
//     * {@inheritdoc}
//     */
//    public function prePersist($object)
//    {
//        if($object->getWorkers()){
//            foreach($object->getWorkers() as $productIngredient) {
//                $productIngredient->setBistro($object);
//            }
//        }
//
//        $object->uploadFile();
//    }
}
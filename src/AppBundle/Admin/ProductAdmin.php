<?php
/**
 * Created by PhpStorm.
 * User: developer-01
 * Date: 8/25/16
 * Time: 11:29 AM
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Bistro;
use Proxies\__CG__\AppBundle\Entity\ProductIngredient;
use Sonata\AdminBundle\Admin\AbstractAdmin as Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
                ->with('Main', array(
                    'class'       => 'col-md-12'/*,
                    'box_class'   => 'box box-solid box-danger',
                    'description' => 'Lorem ipsum',*/
                    // ...
                ))
                    ->add('name', 'text')
                    ->add('ingredients', 'sonata_type_collection', array(), array(
                                    'edit' => 'inline',
                                    'inline' => 'table',
                                    'sortable'  => 'id'
                                ))
                    ->add('createdTime', 'number')
                    ->add('exportPrice', 'number')
                    ->add('file', 'add_file_type', array('required' => false, 'label'=>'Product image'))
                ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('exportPrice')
            ->add('createdTime')
            ->add('created')
            ->add('updated')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->addIdentifier('exportPrice')
            ->addIdentifier('createdTime')
            ->add('ingredients')
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
        if($object->getIngredients()){
            foreach($object->getIngredients() as $productIngredient) {
                    $productIngredient->setProduct($object);
                }
        }

        $object->uploadFile();
    }
    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        if($object->getIngredients()){
            foreach($object->getIngredients() as $productIngredient) {
                    $productIngredient->setProduct($object);
            }
        }
        $object->uploadFile();
    }

}
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

class ProductIngredientAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Post')
                ->with('Main', array(
                    'class'       => 'col-md-9',
                    'box_class'   => 'box box-solid box-danger',
                    'description' => 'Lorem ipsum',
                    // ...
                ))
                    ->add('importPrice', 'number')
                    ->add('createdTime', 'number')
                ->end()
                ->with('Description', array('class' => 'col-md-3'))
                    ->add('ingredientProportion', 'text')
                    ->add('ingredientUnit', null)
                ->end()
            ->end()
            ->tab('Test')
                ->with('Parent', array('class' => 'col-md-12'))
                    ->add('product', 'number')
                    ->add('ingredient', 'number')
                    /*->add('workers', 'entity', array(
                                    'class' => 'AppBundle\Entity\User',
                                    'property' => 'username',
                                    'label'=>'Select Worker'
                                ))*/
                ->end()
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('product')
            ->add('ingredient')
            ->add('ingredientUnit')
            ->add('importPrice')
            ->add('createdTime')
           /* ->add('workers', null, array(), 'entity', array(
                'class'    => 'AppBundle\Entity\User',
                'property' => 'username',
            ))*/
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
            ->add('product')
            ->add('ingredient')
            ->addIdentifier('ingredientUnit')
            ->addIdentifier('importPrice')
            ->addIdentifier('createdTime')
            /* ->add('workers', null, array(), 'entity', array(
                 'class'    => 'AppBundle\Entity\User',
                 'property' => 'username',
             ))*/
            ->add('created')
            ->add('updated')
        ;
    }

}
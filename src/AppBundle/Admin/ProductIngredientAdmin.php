<?php
/**
 * Created by PhpStorm.
 * User: developer-01
 * Date: 8/25/16
 * Time: 11:29 AM
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Bistro;
use AppBundle\Entity\ProductIngredient;
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
                ->with('Main', array(
                    'class'       => 'col-md-12',
                    'box_class'   => 'box box-solid box-danger',
                    'description' => 'Lorem ipsum',
                    // ...
                ))
                /*->add('product', 'sonata_type_model_list',
                    array(
                    ), array(
                        'placeholder' => 'No author selected'
                    ))*/
                    ->add('ingredient', 'sonata_type_model_list',
                        array(
                        ), array(
                            'placeholder' => 'No author selected'
                        ))
                    ->add('ingredientProportion', 'text', array('required'=>false))
                    ->add('ingredientUnit', 'choice', array('choices' =>
                            array(ProductIngredient::KG=> 'Kg',
                                ProductIngredient::LITER=>'Liter',
                                ProductIngredient::CM=>'Cm')
                        )
                    )
                    ->add('importPrice', 'number')
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
            /* ->add('workers', null, array(), 'entity', array(
                 'class'    => 'AppBundle\Entity\User',
                 'property' => 'username',
             ))*/
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

}
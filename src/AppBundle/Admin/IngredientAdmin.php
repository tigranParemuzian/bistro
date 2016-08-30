<?php
/**
 * Created by PhpStorm.
 * User: developer-01
 * Date: 8/25/16
 * Time: 11:29 AM
 */

namespace AppBundle\Admin;

use AppBundle\Entity\Ingredient;
use Sonata\AdminBundle\Admin\AbstractAdmin as Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class IngredientAdmin extends Admin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->tab('Post')
                ->with('Main', array('class' => 'col-md-9'))
                    ->add('name', 'text')
                    ->add('isReady')
                    ->add('file', 'add_file_type', array('required' => false, 'label'=>'Cars type image image'))
                ->end()
            ->end()
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('created')
            ->add('updated')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->addIdentifier('isReady',  null, array('editable'=>true))
            ->add('created')
            ->add('updated')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function preUpdate($object)
    {
        $object->uploadFile();
    }
    /**
     * {@inheritdoc}
     */
    public function prePersist($object)
    {
        $object->uploadFile();
    }

}
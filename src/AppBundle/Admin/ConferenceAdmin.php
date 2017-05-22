<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ConferenceAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('start_time')
            ->add('end_time')
            ->add('call_for_papers_start')
            ->add('call_for_papers_end')
            ->add('paper_submission_start')
            ->add('paper_submission_end');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('start_time')
            ->add('end_time')
            ->add('call_for_papers_start')
            ->add('call_for_papers_end')
            ->add('paper_submission_start')
            ->add('paper_submission_end');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->addIdentifier('name')
            ->addIdentifier('start_time')
            ->addIdentifier('end_time')
            ->addIdentifier('call_for_papers_start')
            ->addIdentifier('call_for_papers_end')
            ->addIdentifier('paper_submission_start')
            ->addIdentifier('paper_submission_end');
    }
}
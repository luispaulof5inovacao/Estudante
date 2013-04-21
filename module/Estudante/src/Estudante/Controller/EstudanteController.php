<?php
namespace Estudante\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Estudante\Model\Estudante;          // <-- Add this import
use Estudante\Form\EstudanteForm;       // <-- Add this import

class EstudanteController extends AbstractActionController
{
    protected $estudanteTable;
    
    public function indexAction()
    {
          return new ViewModel(array(
            'estudantes' => $this->getEstudanteTable()->fetchAll(),
        ));
    }

      // Add content to this method:
    public function addAction()
    {
        $form = new EstudanteForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $estudante = new Estudante();
            $form->setInputFilter($estudante->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $estudante->exchangeArray($form->getData());
                $this->getEstudanteTable()->saveEstudante($estudante);

                // Redirect to list of estudante
                return $this->redirect()->toRoute('estudante');
            }
        }
        return array('form' => $form);
    }

    public function editAction()
    {
    }

    public function deleteAction()
    {
    }
       public function getEstudanteTable()
    {
        if (!$this->estudanteTable) {
            $sm = $this->getServiceLocator();
            $this->estudanteTable = $sm->get('Estudante\Model\EstudanteTable');
        }
        return $this->estudanteTable;
    }
}
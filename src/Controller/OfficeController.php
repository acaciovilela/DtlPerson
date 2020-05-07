<?php

namespace DtlPerson\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use DtlPerson\Form\Office as OfficeForm;
use DtlPerson\Entity\Office as OfficeEntity;
use Doctrine\ORM\EntityManager;
use Laminas\View\Model\ViewModel;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Laminas\Paginator\Paginator;

class OfficeController extends AbstractActionController {

    /**
     * @var Office\Entity\OfficeEntity
     */
    protected $repository;

    /**
     * @
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function indexAction() {
        $adapter = new DoctrineAdapter(
                new DoctrinePaginator($this->getEntityManager()
                        ->getRepository($this->getRepository())
                ->createQueryBuilder('o')
                ->where('o.user = ' . $this->identity()->getId())
                ->orderBy('o.name')
        ));

        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage(10);

        $page = $this->params()->fromRoute('page');

        if ($page) {
            $paginator->setCurrentPageNumber($page);
        }

        return new ViewModel([
            'offices' => $paginator,
        ]);
    }

    public function addAction() {
        $form = new OfficeForm($this->getEntityManager());
        $office = new OfficeEntity();
        $form->bind($office);
        if ($this->request->isPost()) {
            $post = $this->request->getPost();
            $form->setData($post);
            if ($form->isValid()) {
                $em = $this->getEntityManager();
                $office->setUser($em->find(\DtlUser\Entity\User::class, $this->identity()->getId()));
                $em->persist($office);
                $em->flush();
                $this->flashMessenger()->addSuccessMessage('Cargo cadastrado com sucesso!');
                return $this->redirect()->toRoute('dtl-admin/dtl-office');
            } else {
                $this->flashMessenger()->addErrorMessage('Ocorreu um erro ao tentar gravar os dados!');
            }
        }
        return array(
            'form' => $form
        );
    }

    public function editAction() {
        $id = (int) $this->params()->fromRoute('id');
        $em = $this->getEntityManager();
        $office = $em->find($this->getRepository(), $id);
        if (!$office) {
            return $this->redirect()->toRoute('dtl-admin/dtl-office/add');
        }
        $form = new OfficeForm($this->getEntityManager());
        $form->bind($office);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $em->persist($office);
                $em->flush();
                $this->flashMessenger()->addSuccessMessage('Cargo atualizado com sucesso!');
                return $this->redirect()->toRoute('dtl-admin/dtl-office');
            } else {
                $this->flashMessenger()->addErrorMessage('Ocorreu um erro ao tentar gravar os dados!');
            }
        }
        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction() {
        $em = $this->getEntityManager();
        $id = $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('dtl-admin/dtl-office');
        }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Não');
            if ($del == 'Sim') {
                $id = $request->getPost('id');
                $em->remove($em->find($this->getRepository(), $id));
                $em->flush();
                $this->flashMessenger()->addSuccessMessage('Cargo apagado com sucesso!');
            }
            return $this->redirect()->toRoute('dtl-admin/dtl-office');
        }
        return array(
            'id' => $id,
            'office' => $em->find($this->getRepository(), $id),
        );
    }

    /**
     * @return the $entityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

    /**
     * @param field_type $entityManager
     */
    public function setEntityManager(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @return the $repository
     */
    public function getRepository() {
        return $this->repository;
    }

    /**
     * @param field_type $repository
     */
    public function setRepository($repository) {
        $this->repository = $repository;
    }

}

<?php


namespace App\Controller;


use App\Document\Users;
use Doctrine\ODM\MongoDB\DocumentManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UsersController
 * @package App\Controller
 */
class UsersController extends AbstractFOSRestController
{
    /**
     * @var DocumentManager
     */
    private $documentManager;

    /**
     * UsersController constructor.
     * @param DocumentManager $documentManager
     */
    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }

    /**
     * @Rest\Get("/users")
     */
    public function index()
    {
        $users = $this->documentManager->getRepository(Users::class)->findAll();
        return $this->json($users, 200);
    }

    /**
     * @Rest\Post("/users")
     * @param Request $request
     * @throws \Doctrine\ODM\MongoDB\MongoDBException
     */
    public function postUser(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            $users = new Users();
            if (!isset($data['username']))
            {
                throw new \Exception('Set username!');
            }
            $users->setUsername($data['username']);
            $this->documentManager->persist($users);
            $this->documentManager->flush();
        } catch (\Exception $exception)
        {
            return $this->json([
                'error' => $exception->getCode(),
                'msg' => $exception->getMessage()], 400);
        }
        return $this->json(['success'], 200);
    }


}
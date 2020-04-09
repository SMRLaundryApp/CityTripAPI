<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OpenController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/OpenController.php',
        ]);
    }
    /**
     * @Route("/api/CategoryAdding/{user}", name="api_user_category", methods={"POST"})
     */
    public function CategoryToUser($user, EntityManagerInterface $em, Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $userCheck = $this->getDoctrine()->getRepository(User::class)->find($user);
        if (!empty($userCheck)) {
            $Categories = $userCheck->getCategories();
            foreach ($Categories as $category){
                $userCheck->removeCategory($category);
                $em->persist($userCheck);
                $em->flush();
            }
            foreach ($data['categories'] as $categoryId){
                $Category = $this->getDoctrine()->getRepository(Category::class)->find($categoryId);
                $userCheck->addCategory($Category);
                $em->persist($userCheck);
                $em->flush();
            }
            return $this->json([
                'user' => $userCheck,
            ]);
        }else{
            return $this->json([
                'error' => "User not found",
            ]);
        }
    }
}

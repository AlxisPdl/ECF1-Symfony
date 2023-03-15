<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\User;
use App\Entity\Livre;
use App\Entity\Auteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class TestFixtures extends Fixture
{
    private $doctrine;
    private $faker;
    private $hasher;
    private $manager;

    public function __construct(ManagerRegistry $doctrine, UserPasswordHasherInterface $hasher)
    {
        $this->doctrine = $doctrine;
        $this->faker = FakerFactory::create('fr_FR');
        $this->hasher = $hasher;


    }

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;

        $this->loadUser();
        $this->loadLivre();
        $this->loadAuteur();
    }


    public function loadUser(): void
    {
        $datas = [
            [
                'email' => 'admin@example.com',
                'roles' => ["ROLE_ADMIN"],
                'password' => 'motdepasse',
                'enable' => true,
                'created_at' => DateTime::createFromFormat('Ymd H:i:s', '20200101 09:00:00'),
                'updated_at' => DateTime::createFromFormat('Ymd H:i:s', '20200101 09:00:00')


            ],
            [
                'email' => 'foo.foo@example.com',
                'roles' => ["ROLE_USER"],
                'password' => 'motdepasse',
                'enable' => true,
                'created_at' => DateTime::createFromFormat('Ymd H:i:s', '20200101 10:00:00'),
                'updated_at' => DateTime::createFromFormat('Ymd H:i:s', '20200101 10:00:00')


            ],
            [
                'email' => 'bar.bar@example.com',
                'roles' => ["ROLE_USER"],
                'password' => 'motdepasse',
                'enable' => false,
                'created_at' => DateTime::createFromFormat('Ymd H:i:s', '20200201 11:00:00'),
                'updated_at' => DateTime::createFromFormat('Ymd H:i:s', '20200501 12:00:00')


            ],
            [
                'email' => 'baz.baz@example.com',
                'roles' => ["ROLE_USER"],
                'password' => 'motdepasse',
                'enable' => true,
                'created_at' => DateTime::createFromFormat('Ymd H:i:s', '20200301 12:00:00'),
                'updated_at' => DateTime::createFromFormat('Ymd H:i:s', '20200301 12:00:00')


            ]
        ];


        foreach ($datas as $data) {
            // création d'un nouvel objet
            $user = new User();
            // affectation des valeurs statiques
            $user->setEmail($data['email']);
            $user->setRoles($data['roles']);
            $user->setPassword($data['password']);
            $user->setEnabled($data['enable']);
            $user->setCreatedAt($data['created_at']);
            $user->setUpdatedAt($data['updated_at']);



            // demande d'enregistrement de l'objet
            $this->manager->persist($user);
        }
        ;

        for ($i = 0; $i < 100; $i++) {
            // création d'un nouvel objet
            $user = new user();
            // affectation des valeurs dynamiques
            $user->setEmail($this->faker->email());
            $user->setRoles(['ROLE_USER']);
            $user->SetPassword($this->faker->password());
            $user->SetEnabled($this->faker->boolean());
            $user->setCreatedAt($this->faker->dateTimeBetween('-10 week', '-6 week'));
            $user->setUpdatedAt($this->faker->dateTimeBetween('+8 week', '+12 week'));

            // demande d'enregistrement de l'objet
            $this->manager->persist($user);
        }
        ;

        $this->manager->flush();
    }

    public function loadLivre(): void
    {
        $datas = [
            [
                'titre' => 'Lorem ipsum dolor sit amet',
                'nombre_pages' => 100,
                'code_isbn' => 9785786930024,
                'annee_edition' => 2010



            ],
            [
                'titre' => 'Consectetur adipiscing elit',
                'nombre_pages' => 150,
                'code_isbn' => 9783817260935,
                'annee_edition' => 2011



            ],
            [
                'titre' => 'Mihi quidem Antiochum',
                'nombre_pages' => 200,
                'code_isbn' => 9782020493727,
                'annee_edition' => 2012



            ],
            [
                'titre' => 'Quem audis satis belle',
                'nombre_pages' => 250,
                'code_isbn' => 9794059561353,
                'annee_edition' => 2013



            ],
        ];


        foreach ($datas as $data) {
            // création d'un nouvel objet
            $livre = new Livre();
            // affectation des valeurs statiques
            $livre->setTitre($data['titre']);
            $livre->setNombrePages($data['nombre_pages']);
            $livre->setCodeIsbn($data['code_isbn']);
            $livre->setAnneeEdition($data['annee_edition']);



            // demande d'enregistrement de l'objet
            $this->manager->persist($livre);
        }
        ;

        for ($i = 0; $i < 1000; $i++) {
            // création d'un nouvel objet
            $livre = new livre();
            // affectation des valeurs dynamiques
            $livre->setTitre($this->faker->word());
            $livre->setNombrePages($this->faker->randomNumber(3, false));
            $livre->SetCodeIsbn($this->faker->numerify('#############'));
            $livre->SetAnneeEdition($this->faker->year());

            // demande d'enregistrement de l'objet
            $this->manager->persist($livre);
        }
        ;

        $this->manager->flush();
    }

    public function loadAuteur(): void
    {
        $datas = [
            [
                'nom' => 'auteur inconnu',
                'prenom' => '',




            ],
            [
                'nom' => 'Cartier',
                'prenom' => 'Hugues',




            ],
            [
                'nom' => 'Lambert',
                'prenom' => 'Armand',




            ],
            [
                'nom' => 'Moitessier',
                'prenom' => 'Thomas',
            ],

        ];


        foreach ($datas as $data) {
            // création d'un nouvel objet
            $auteur = new Auteur();
            // affectation des valeurs statiques
            $auteur->setNom($data['nom']);
            $auteur->setPrenom($data['prenom']);




            // demande d'enregistrement de l'objet
            $this->manager->persist($auteur);
        }
        ;

        for ($i = 0; $i < 500; $i++) {
            // création d'un nouvel objet
            $auteur = new auteur();
            // affectation des valeurs dynamiques
            $auteur->setNom($this->faker->word());
            $auteur->setPrenom($this->faker->word());


            // demande d'enregistrement de l'objet
            $this->manager->persist($auteur);
        }
        ;

        $this->manager->flush();
    }

    public function loadGenre(): void
    {
        $datas = [
            [
                'nom' => 'auteur inconnu',
                'prenom' => '',




            ],
            [
                'nom' => 'Cartier',
                'prenom' => 'Hugues',




            ],
            [
                'nom' => 'Lambert',
                'prenom' => 'Armand',




            ],
            [
                'nom' => 'Moitessier',
                'prenom' => 'Thomas',
            ],

        ];


        foreach ($datas as $data) {
            // création d'un nouvel objet
            $auteur = new Auteur();
            // affectation des valeurs statiques
            $auteur->setNom($data['nom']);
            $auteur->setPrenom($data['prenom']);




            // demande d'enregistrement de l'objet
            $this->manager->persist($auteur);
        }
        ;

        for ($i = 0; $i < 500; $i++) {
            // création d'un nouvel objet
            $auteur = new auteur();
            // affectation des valeurs dynamiques
            $auteur->setNom($this->faker->word());
            $auteur->setPrenom($this->faker->word());


            // demande d'enregistrement de l'objet
            $this->manager->persist($auteur);
        }
        ;

        $this->manager->flush();
    }
}
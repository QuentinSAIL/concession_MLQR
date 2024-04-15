# Documentation de Test Technique pour le Projet de Concession Automobile

## Mise en Contexte

Ce projet est une application Laravel conçue pour gérer une concession automobile.
Cette application s'adresse principalement aux gestionnaires de concessions automobiles qui ont besoin d'un système fiable pour suivre l'inventaire de leurs automobiles en temps réel.

Elle offre plusieurs fonctionnalités clés :

## Gestion d’un inventaire de voitures

-   Affichage de la liste des marques
-   Affichage d'une seule marque
-   modification d'une marque
-   supression d'une marque
-   création d'une marque

---

-   Affichage de la liste des modeles
-   Affichage d'un seul modele
-   modification d'un modele
-   supression d'un modele
-   création d'un modele

---

-   rattacher une voiture à un modele
-   supprimer une voiture
-   lister toutes les voitures

---

## Priorisation des Tests

Les tests sont priorisés selon l'importance des fonctionnalités pour les utilisateurs finaux et la stabilité de l'application. Les fonctionnalités critiques telles que l'affichage des listes de voitures et de marques ainsi que la suppression de voitures seront testées en premier. Cela est dû à leur impact direct sur l'expérience utilisateur et l'intégrité des données.

### Choix Technologiques

_PHPUnit_ : Utilisé pour les tests unitaires et d'intégration, car il est nativement supporté par Laravel. Il permet une intégration facile avec les migrations et les factories de la base de données, facilitant la réplication des scénarios de test.
Détails Techniques des Tests

## 1. Test de l'affichage des marques :

Type de Test : Test unitaire
Ce test vérifie que la méthode responsable de récupérer les marques des voitures de l'inventaire renvoie une liste.

### Implémentation :

Utiliser BrandFactory pour créer plusieurs entrées de voitures avec des marques dupliquées.
Appeler la méthode test_can_get_all_brands() pour récupérer les marques.

 ````
 public function test_can_get_all_brands(): void
    {
        $brands = Brand::factory()->count(3)->create();
        $response = $this->get(route('brand.index'));
        $response->assertStatus(200)
            ->assertJson($brands->toArray());
    }
 ````

## 2. Test de suppression d'une voiture :
   Type de Test : Test d'intégration
   Ce test assure que la suppression d'une voiture via l'interface de l'application supprime effectivement l'entrée dans la base de données.
   
   ### Implémentation :

   Créer une entrée de voiture via CarFactory.
   Exécuter la méthode deleteCar() sur cette entrée.
   Vérifier via une assertion que la voiture n'est plus présente dans la base de données.
````
    public function test_can_update_brand(): void
    {
        $brand = Brand::factory()->create();
        $data = ['name' => 'Updated Brand'];

        $response = $this->putJson(route('brand.update', $brand->id), $data);

        $response->assertStatus(200);

    }
````

#   Conclusion
   Ces tests sont conçus pour garantir que les fonctionnalités clés de l'application fonctionnent comme attendu et maintiennent l'intégrité des données au sein de l'inventaire. L'approche choisie permet d'assurer une qualité constante et de détecter les régressions ou anomalies avant la mise en production.

# Documentation Technique Détaillée pour le Projet de Concession Automobile

## Introduction

Le présent document fournit une documentation technique détaillée pour une application Laravel destinée à la gestion d'une concession automobile. L'application est conçue pour les gestionnaires de concessions souhaitant une solution robuste pour le suivi en temps réel de leur inventaire automobile.

## Objectifs du Projet

Cette application vise à fournir une interface utilisateur intuitive et une base de données fiable pour gérer efficacement les stocks de véhicules, les marques, et les modèles de voitures. Elle doit permettre une gestion facile et précise, minimisant les erreurs et les doublons dans les entrées de données.

## Fonctionnalités Principales

### Gestion d’un Inventaire de Voitures

L'application offre une série de fonctionnalités destinées à faciliter la gestion de l'inventaire de véhicules :

#### Gestion des Marques

- **Affichage de la liste des marques** : Permet aux utilisateurs de voir toutes les marques disponibles dans l'inventaire.
- **Affichage d'une seule marque** : Permet aux utilisateurs de consulter les détails d'une marque spécifique.
- **Création d'une marque** : Offre une interface pour ajouter de nouvelles marques à l'inventaire.
- **Modification d'une marque** : Permet de mettre à jour les informations d'une marque existante.
- **Suppression d'une marque** : Permet de retirer une marque de l'inventaire, après confirmation.

#### Gestion des Modèles

- **Affichage de la liste des modèles** : Affiche tous les modèles de voitures associés à une marque spécifique.
- **Affichage d'un seul modèle** : Affiche les détails d'un modèle particulier.
- **Création d'un modèle** : Interface pour ajouter de nouveaux modèles dans la base de données.
- **Modification d'un modèle** : Mise à jour des informations relatives à un modèle spécifique.
- **Suppression d'un modèle** : Supprime un modèle de la base de données après une vérification appropriée.

#### Gestion des Voitures

- **Rattachement d'une voiture à un modèle** : Associe une voiture nouvellement entrée ou existante à un modèle spécifique.
- **Suppression d'une voiture** : Permet de supprimer une voiture de l'inventaire.
- **Liste de toutes les voitures** : Affiche toutes les voitures présentes dans l'inventaire, avec des options de filtrage et de tri.

## Priorisation des Tests
Les tests sont priorisés selon l'importance des fonctionnalités pour les utilisateurs finaux et la stabilité de l'application. Les fonctionnalités critiques telles que l'affichage des listes de voitures et de marques ainsi que la suppression de voitures seront testées en premier. Cela est dû à leur impact direct sur l'expérience utilisateur et l'intégrité des données.

### Choix Technologiques

_PHPUnit_ : Utilisé pour les tests unitaires et d'intégration, car il est nativement supporté par Laravel. Il permet une intégration facile avec les migrations et les factories de la base de données, facilitant la réplication des scénarios de test.
Détails Techniques des Tests

## 1. Test de l'affichage des marques :

Ce test vérifie que la méthode responsable de récupérer les marques des voitures de l'inventaire renvoie une liste.

### Implémentation :

Utiliser Brand::factory pour créer plusieurs entrées de voitures.
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

## 2. Test de modification d'une marque :

   Ce test assure que la modification d'une marque via l'interface de l'application fonctionne correctement.
   
   ### Implémentation :

   Créer une entrée de marque via Brand::Factory.
   Exécuter la méthode test_can_update_brand() sur cette entrée.
   Vérifier via une assertion de la réponse que la marque est modifiée dans la BDD.
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

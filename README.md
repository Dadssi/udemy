# Youdemy - Plateforme de Cours en Ligne

Youdemy est une plateforme innovante de cours en ligne conçue pour révolutionner l'apprentissage grâce à un système interactif et personnalisé pour les étudiants et les enseignants.

---

## **Contexte du Projet**

La plateforme Youdemy vise à offrir une expérience d'apprentissage enrichissante et interactive en intégrant des fonctionnalités avancées adaptées aux besoins des utilisateurs.

---

## **Fonctionnalités Principales**

### **Partie Front Office**

#### **Visiteur**
- Accès au catalogue des cours avec pagination.
- Recherche de cours par mots-clés.
- Création d'un compte avec choix du rôle (Étudiant ou Enseignant).

#### **Étudiant**
- Visualisation du catalogue des cours.
- Recherche et consultation des détails des cours (description, contenu, enseignant, etc.).
- Inscription à un cours après authentification.
- Accès à une section "Mes cours" regroupant les cours rejoints.

#### **Enseignant**
- Ajout de nouveaux cours avec les détails suivants :
  - Titre, description, contenu (vidéo ou document), tags, catégorie.
- Gestion des cours : modification, suppression et consultation des inscriptions.
- Accès à une section "Statistiques" sur les cours :
  - Nombre d’étudiants inscrits, nombre de cours, etc.

### **Partie Back Office**

#### **Administrateur**
- Validation des comptes enseignants.
- Gestion des utilisateurs : activation, suspension ou suppression.
- Gestion des contenus : cours, catégories et tags.
- Insertion en masse de tags pour gagner en efficacité.
- Accès à des statistiques globales :
  - Nombre total de cours, répartition par catégorie.
  - Le cours avec le plus d'étudiants.
  - Les Top 3 enseignants.

### **Fonctionnalités Transversales**
- Un cours peut contenir plusieurs tags (relation many-to-many).
- Application du concept de polymorphisme dans les méthodes : ajout et affichage des cours.
- Système d’authentification et d’autorisation pour protéger les routes sensibles.
- Contrôle d'accès : chaque utilisateur accède uniquement aux fonctionnalités correspondant à son rôle.

---

## **Exigences Techniques**

- Respect des principes OOP (encapsulation, héritage, polymorphisme).
- Base de données relationnelle avec gestion des relations (one-to-many, many-to-many).
- Utilisation des sessions PHP pour la gestion des utilisateurs connectés.
- Système de validation des données utilisateur pour garantir la sécurité.

---

## **Bonus**

- Recherche avancée avec filtres (catégorie, tags, auteur).
- Statistiques avancées : taux d'engagement par cours, catégories les plus populaires.
- Système de notifications : validation de compte enseignant, confirmation d'inscription à un cours.
- Implémentation d’un système de commentaires ou d'évaluations sur les cours.
- Génération de certificats PDF de complétion pour les étudiants.

---

## **Modalités Pédagogiques**

- **Travail** : individuel.
- **Durée de travail** : 5 jours.
- **Date de lancement** : 13/01/2025 à 09:00 am.
- **Date limite de soumission** : 20/01/2025 avant 05:30 pm.

---

## **Modalités d'Évaluation**

Durée de 35 minutes organisées comme suit :
- **Démonstration et défense publique** : ~10 minutes pour présenter le contenu et les fonctionnalités du site web (démonstration + explication du code source).
- **Code Review & Questions culture web** : 10 minutes.
- **Mise en situation** : 15 minutes.

---

## **Livrables**

1. Lien du repository GitHub du projet.
2. Lien de la présentation.
3. Diagrammes UML :
   - Diagramme des cas d'utilisation.
   - Diagramme de classes.

---

## **Critères de Performance**

1. La logique métier et l'architecture doivent être clairement séparées.
2. Cohérence dans l'application des concepts OOP.
3. Amélioration de la structure et de la lisibilité du code.
4. Utilisation appropriée des classes, objets, méthodes, etc.
5. Les pages web doivent être responsive et adaptées à tous les types d’écrans.
6. Validation côté client (HTML5 et JavaScript) pour minimiser les erreurs avant la soumission des formulaires.
7. Validation côté serveur avec des mesures de sécurité :
   - Protection contre les attaques Cross-Site Scripting (XSS) et Cross-Site Request Forgery (CSRF).
   - Utilisation de requêtes préparées pour prévenir les attaques SQL injection.
   - Validation et échappement des données d'entrée.

---

Réalisez une plateforme qui reflète votre expertise et vos compétences en développement web tout en respectant ces directives. Bonne chance !


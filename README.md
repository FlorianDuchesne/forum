# forum
 
Mini-framework.

Emploi du MVC (Modèle-Vue-Contrôleur)

Fonctionnalités :
inscription et connexion d'un utilisateur.
Un utilisateur inscrit peut créer des sujets, créer des messages, répondre à des messages, éditer et supprimer ses propres messages.

Un utilisateur au statut d'administrateur peut rajouter et modifier des catégories, supprimer des sujets, clore des sujets (le sujet peut être lu mais on ne peut plus y ajouter de nouveaux messages), supprimer les messages de n'importe qui, supprimer un compte utilisateur. 

La barre de recherche est fonctionnelle et cherche du contenu parmi les sujets, messages et utilisateurs.

Prévention des failles XSS avec l'emploi de filter_input et des injections SQL avec des requêtes préparées.
Prévention des failles CSRF encore à venir. 

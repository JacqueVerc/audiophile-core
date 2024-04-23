# Audiophile - Boutique e-commerce

### Links

- Live Site URL: [Audiophile](https://audiophile.bwat.live)

## Screenshot

![](./assets/audiophile.png)

## Fonctionnalités :

Login / Inscription -- OK \
Parcours par catégories -- OK \
Parcours des articles -- OK \
Mise au panier -- OK \
Ajustement des quantités -- OK \
Validation de la commande -- OK \
Ajout d'un produit -- OK \
Ajout d'une catégorie -- OK \

## Commandes

### `composer install` 
### `php bin/console sass:build`
### `symfony server:start`


## Infos sur le projet
Nous sommes partis avec une idée d'avoir un service premium et de qualité. Avoir très peu de produit mais avoir un rendu et une expérience plaisante. 
Les catégories et les produits sont ajoutés directement grâce aux fixtures donc en base de données (et non créé depuis la route admin). 
Bien sûr étant une fonctionnalité demandé, elle a été mise en place, mais elle ne modifie pas l'affichage.
Le produit apparaît si la catégorie est bien précisé. Mais elle ne possédera pas les images. 
Le procédé pour la catégorie et le même sauf que la catégorie ne sera pas visible sur le site. Mais visible sur la page de création (voir route ci-dessous).

Nous avons aussi créé des routes pour que vous puissez tester, bien sûr vous pouvez créer un utilisateur. 

## Infos admin
Identifiants : admin@admin.fr
Mot de passe : admin1234

Routes pour accéder à l'ajout de catégorie et de produits depuis l'admin.
[Page admin ajout de catégorie]([https://audiophile.bwat.live](https://audiophile.bwat.live/admin/add/category))
[Page admin ajout de produit]([https://audiophile.bwat.live](https://audiophile.bwat.live/admin/add/product))

## Infos user
Identifiants : test@test.fr
Mot de passe : test1234

# Auteurs

|                                                                      |                                                                                |
| -------------------------------------------------------------------- | ------------------------------------------------------------------------------ |
| <img src="https://github.com/JacqueVerc.png" alt="Jacques" width="200"> | <img src="https://github.com/Alexandre-st.png" alt="Alexandre-st" width="200"> |
| [**Jacques**](https://github.com/JacqueVerc)                                | [**Alexandre**](https://github.com/Alexandre-st)                         |

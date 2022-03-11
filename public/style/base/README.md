# Base

Le dossier `base/` contient ce que l'on pourrait appeler le code de base du projet. Vous y trouverez le fichier de réinitialisation, quelques règles typographiques, et probablement une feuille de style définissant des styles standard pour les éléments HTML les plus utilisés (que j'aime appeler _base.scss).

*Note — Exemple :*

_base.scss
_reset.scss
_typographie.scss

Si votre projet utilise beaucoup d'animations CSS, vous pouvez envisager d'ajouter un fichier \_animations.scss contenant les définitions @keyframes de toutes vos animations. Si vous ne les utilisez que sporadiquement, laissez-les vivre avec les sélecteurs qui les utilisent.
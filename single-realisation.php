<?php
/**
 * Template single réalisation — Studio Web 61
 * Fichier : single-realisation.php (racine du thème enfant)
 */

get_header();

while ( have_posts() ) : the_post();

    $nom_projet             = get_field('nom_projet');
    $url_client             = get_field('url_client');
    $ville                  = get_field('ville');
    $departement_pays       = get_field('departement_pays');
    $annee                  = get_field('annee_realisation');
    $presentation           = get_field('presentation_prestation');
    $temoignage             = get_field('temoignage_client');
    $mise_en_avant          = get_field('mise_en_avant');
    $fonctionnalites        = get_field('fonctionnalites_metier');

    $prestations            = get_the_terms( get_the_ID(), 'prestation' );
    $secteurs               = get_the_terms( get_the_ID(), 'secteur_pro' );
    $zones                  = get_the_terms( get_the_ID(), 'zone_geo' );

    $has_fonctionnalites_metier = $prestations && ! is_wp_error( $prestations )
        ? array_filter( $prestations, fn($t) => $t->slug === 'fonctionnalites-metier' )
        : [];

?>

<article class="sw61-single-realisation">

    <!-- EN-TÊTE -->
    <header class="sr-header">
        <h1 class="sr-titre"><?php echo esc_html( $nom_projet ?: get_the_title() ); ?></h1>
        <?php if ( $annee ) : ?>
            <span class="sr-annee"><?php echo intval( $annee ); ?></span>
        <?php endif; ?>
    </header>

    <!-- IMAGE MOCKUP -->
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="sr-mockup">
            <?php the_post_thumbnail( 'large', [ 'class' => 'sr-mockup-img', 'loading' => 'lazy' ] ); ?>
        </div>
    <?php endif; ?>

    <!-- SECTEUR PRO -->
    <?php if ( $secteurs && ! is_wp_error( $secteurs ) ) : ?>
        <p class="sr-secteur">
            <strong>Secteur : </strong>
            <?php echo esc_html( implode( ', ', wp_list_pluck( $secteurs, 'name' ) ) ); ?>
        </p>
    <?php endif; ?>

    <!-- DESCRIPTION ENTREPRISE / PRÉSENTATION -->
    <?php if ( $presentation ) : ?>
        <div class="sr-presentation">
            <?php echo wpautop( esc_html( $presentation ) ); ?>
        </div>
    <?php endif; ?>

    <!-- LOCALISATION -->
    <?php if ( $ville || $zones ) : ?>
        <div class="sr-localisation">
            <strong>Localisation : <?php echo esc_html( $ville ); ?></strong>
            <?php if ( $zones && ! is_wp_error( $zones ) ) : ?>
                <br><?php echo esc_html( implode( ' | ', wp_list_pluck( $zones, 'name' ) ) ); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- PRESTATIONS -->
    <?php if ( $prestations && ! is_wp_error( $prestations ) ) : ?>
        <ul class="sr-prestations">
            <?php foreach ( $prestations as $term ) :
                if ( $term->slug === 'fonctionnalites-metier' ) continue; ?>
                <li class="sr-prestation-item">
                    <span class="sr-star sr-star--vert">★</span>
                    <?php echo esc_html( $term->name ); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <!-- FONCTIONNALITÉS MÉTIER -->
    <?php if ( $has_fonctionnalites_metier && $fonctionnalites ) : ?>
        <div class="sr-fonctionnalites">
            <p class="sr-fonctionnalites-titre">
                <span class="sr-star sr-star--corail">★</span>
                Fonctionnalités métier
                <span class="sr-star sr-star--corail">★</span>
            </p>
            <ul class="sr-fonctionnalites-liste">
                <?php foreach ( $fonctionnalites as $item ) : ?>
                    <li><?php echo esc_html( $item ); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- TÉMOIGNAGE CLIENT -->
    <?php if ( $temoignage ) : ?>
        <div class="sr-temoignage">
            <p class="sr-temoignage-label"><strong>Témoignage client :</strong></p>
            <blockquote class="sr-temoignage-texte">
                <?php echo wpautop( esc_html( $temoignage ) ); ?>
            </blockquote>
        </div>
    <?php endif; ?>

    <!-- LIEN SITE CLIENT -->
    <?php if ( $url_client ) : ?>
        <div class="sr-lien-client">
            <a href="<?php echo esc_url( $url_client ); ?>" target="_blank" rel="noopener noreferrer" class="sr-lien">
                Aller sur le site <?php echo esc_html( $nom_projet ?: get_the_title() ); ?>
                <span class="sr-lien-arrow" aria-hidden="true">↗</span>
            </a>
        </div>
    <?php endif; ?>

</article>

<?php endwhile; ?>

<?php get_footer(); ?>

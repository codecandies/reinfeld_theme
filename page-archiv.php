<?php
/**
 * Template Name: Archiv-Übersicht
 * Template Post Type: page
 *
 * Listet alle Themen (Tags), Personen, Orte und Serien mit Beitragsanzahl.
 *
 * @package Reinfeld
 */

get_header();

// ── Taxonomien laden ──────────────────────────────────────────────────────────

$taxonomy_sections = [
    [
        "label" => __("Themen", "reinfeld"),
        "taxonomy" => "post_tag",
        "prefix" => "#",
    ],
    [
        "label" => __("Personen", "reinfeld"),
        "taxonomy" => "persons",
        "prefix" => "",
    ],
    [
        "label" => __("Orte", "reinfeld"),
        "taxonomy" => "locations",
        "prefix" => "",
    ],
    [
        "label" => __("Serien", "reinfeld"),
        "taxonomy" => "series",
        "prefix" => "",
    ],
];
?>
<!-- page-archiv.php -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <h1><?php the_title(); ?></h1>

  <div class="entry-content archiv-content">
    <?php foreach ($taxonomy_sections as $section):

        $terms = get_terms([
            "taxonomy" => $section["taxonomy"],
            "hide_empty" => true,
            "orderby" => "name",
            "order" => "ASC",
        ]);

        if (is_wp_error($terms)) {
            continue;
        }

        // Nur Begriffe mit mindestens 2 Beiträgen anzeigen
        $terms = array_values(array_filter($terms, fn($t) => $t->count >= 2));

        if (empty($terms)) {
            continue;
        }

        // Alphabetisch nach Anfangsbuchstabe gruppieren
        $grouped = [];
        foreach ($terms as $term) {
            $letter = mb_strtoupper(
                mb_substr($term->name, 0, 1, "UTF-8"),
                "UTF-8",
            );
            $grouped[$letter][] = $term;
        }
        ksort($grouped);
        ?>
      <section class="archiv-section">
        <h2 class="archiv-section-title"><?php echo esc_html(
            $section["label"],
        ); ?></h2>
        <div class="archiv-alpha">
          <?php foreach ($grouped as $letter => $letter_terms): ?>
            <div class="archiv-letter-group">
              <span class="archiv-letter" aria-hidden="true"><?php echo esc_html(
                  $letter,
              ); ?></span>
              <ul class="archiv-terms" role="list">
                <?php foreach ($letter_terms as $term): ?>
                  <li class="archiv-term">
                    <a href="<?php echo esc_url(get_term_link($term)); ?>">
                      <?php echo esc_html($section["prefix"] . $term->name); ?>
                    </a>
                    <span class="archiv-count"><?php echo (int) $term->count; ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endforeach; ?>
        </div>
      </section>
    <?php
    endforeach; ?>
  </div>

</article>

<?php get_footer(); ?>

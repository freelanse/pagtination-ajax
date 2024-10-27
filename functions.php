<?php
add_action('wp_ajax_load_page', 'load_page');
add_action('wp_ajax_nopriv_load_page', 'load_page');

function load_page() {
    $paged = isset($_GET['paged']) ? absint($_GET['paged']) : 1;

    // Параметры для WP_Query
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 4,
        'paged' => $paged,
    );

    $query = new WP_Query($args);

    // Начало вывода записей
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>">
                    <picture>
                        <source media="(max-width: 1110px)" srcset="<?php echo wp_get_attachment_url(carbon_get_post_meta(get_the_ID(), 'news_hea2')); ?>" />
                        <source media="(min-width:1111px)" srcset="<?php echo wp_get_attachment_url(carbon_get_post_meta(get_the_ID(), 'news_hea')); ?>" />
                        <img src="<?php echo wp_get_attachment_url(carbon_get_post_meta(get_the_ID(), 'news_hea')); ?>" alt="<?php the_title(); ?>" />
                    </picture>
                    <div class="news__box">
                        <span class="news__link"><?php the_title(); ?></span>
                        <span class="news__date"><?php echo get_the_date('d.m.Y'); ?></span>
                    </div>
                </a>
            </li>
        <?php endwhile;
        wp_reset_postdata(); // Сброс данных поста
    else :
        echo '<p>No posts found</p>'; // Если записи не найдены
    endif;

    die(); // Останавливаем выполнение
}


function my_custom_scripts() {
    wp_enqueue_script('ajax-pagination', get_template_directory_uri() . '/js/ajax-pagination.js', array('jquery'), null, true);
    wp_localize_script('ajax-pagination', 'ajax_object', array('ajaxurl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'my_custom_scripts');


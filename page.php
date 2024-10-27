<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<section class="section container article">
    <ul class="article__list" id="article-list">
        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 4,
            'paged' => 1,
        );
        $query = new WP_Query($args);
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
            wp_reset_postdata();
        endif;
        ?>
    </ul>

    <div class="pagination">
        <ul class="article__pagination">
            <li>
                <?php if ($paged > 1) : ?>
                    <a class="article__chevron--left ajax-pagination" href="#" data-page="<?php echo $paged - 1; ?>">
                        <img src="/wp-content/themes/lawyer/assets/chevron-left.svg" alt="icon-chevron">
                    </a>
                <?php else : ?>
                    <span class="article__chevron--left"><img src="/wp-content/themes/lawyer/assets/chevron-left.svg" alt="icon-chevron"></span>
                <?php endif; ?>
            </li>

            <?php
            $total_pages = $query->max_num_pages;
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i == $paged) {
                    echo '<li class="article__item"><span>' . $i . '</span></li>'; // Активная страница
                } else {
                    echo '<li><a href="#" class="ajax-pagination" data-page="' . $i . '">' . $i . '</a></li>'; // Ссылки на другие страницы
                }
            }
            ?>

            <li>
                <?php if ($paged < $total_pages) : ?>
                    <a class="article__chevron--right ajax-pagination" href="#" data-page="<?php echo $paged + 1; ?>">
                        <img src="/wp-content/themes/lawyer/assets/chevron-left.svg" alt="icon-chevron">
                    </a>
                <?php else : ?>
                    <span class="article__chevron--right"><img src="/wp-content/themes/lawyer/assets/chevron-left.svg" alt="icon-chevron"></span>
                <?php endif; ?>
            </li>
        </ul>
    </div>

</section>

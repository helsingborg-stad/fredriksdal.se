<div class="grid-md-4">
    <a href="{{ the_permalink() }}" class="box box-ticket">
        <h3 class="box-title">
            {{ the_title() }}
            <small class="block-level">Fredriksdal Museer och trädgårdar</small>
        </h3>
        <div class="box-content">
            <div class="excerpt">
                {{ the_excerpt() }}
            </div>
            <div class="date">
                <label><?php _e('Date', 'fredriksdal'); ?></label>
                <span class="value">{{ mysql2date('Y-m-d', get_post_meta(get_the_id(), 'event-date-start', true)) }}</span>
            </div>
            <div class="time clearfix">
                <div class="time-start">
                    <label><?php _e('From', 'fredriksdal'); ?></label>
                    <div class="value">{{ mysql2date('H:i', get_post_meta(get_the_id(), 'event-date-start', true)) }}</div>
                </div>
                <div class="time-end">
                    <label><?php _e('To', 'fredriksdal'); ?></label>
                    <div class="value">{{ mysql2date('H:i', get_post_meta(get_the_id(), 'event-date-end', true)) }}</div>
                </div>
            </div>
        </div>
        <div class="tickets">
           <?php _e('Read more', 'fredriksdal'); ?>
        </div>
    </a>
</div>

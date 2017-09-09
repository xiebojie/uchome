{%extend base.inc.php%}
{%block main%}
<ul>
    <?php foreach ($app_list as $_app):?>
    <li class="col-md-3 media">
        <a href="<?php echo $_app['app_href']?>" class="btn btn-warning btn btn-lg">{%$_app['app_name']%}</a>
    </li>
    <?php endforeach;?>
</ul>
{%endblock%}
<?php
/**
 * Template Name: my_singular
 * Template Post Type: page
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header(1);
?>

<main id="site-content" role="main">

		<h1 style="font-size: 3.6rem;font-weight: 800;line-height: 1.138888889;text-align:center;padding-bottom: 30px"><?php the_title(); ?></h1>

<div class="container">

<?php
    $data = array();
    $nogiblog_xml = simplexml_load_file('http://shopping.yahooapis.jp/ShoppingWebService/V1/itemSearch?appid=dj0zaiZpPXNaeTRZVDBjaXNsciZzPWNvbnN1bWVyc2VjcmV0Jng9MzI-&store_id=belsus');
    $json = json_encode($nogiblog_xml);
    $items = json_decode($json,TRUE);
    $y_shop_items = $items['Result']['Hit'];

    $i = 0;
    foreach ($y_shop_items as $items) {
        $item_title = $items['Name'];
        $item_title = mb_substr($item_title, 0, 47);
        $item_img = $items['Image']['Medium'];
        $item_link = $items['Url'];
        $item_price = $items['Price'];
        $item_review = $items['Review']['Rate'];

        if ($i ==0){
            print '<div class="row">';
        }
        // Bootstrap
        print '<div class="col-sm-3">';
        print '<div class="card mt-3">';
        print '<div class="img"><img class="rouded img-thumbnail" src="'.$item_img.'" alt="Card image cap"></div>';
        print '<div class="card-body">';
        print '<h5 class="card-title">'.$item_title.'</h5>';
        print '<p class="card-text">価格：'.$item_price.'円　(評価：'.$item_review.')</p>';
        print '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="myFunction()">商品詳細</button> </div>';
        print "<script>function myFunction(){setInterval(function(){ window.location.href = '".$item_link."'; }, 200000);}</script>";
        print '</div></div>';
        $i++;

        if ($i ==4){
            print '</div>';
            $i = 0;
        }
    }
?>
</div>

<hr>

<!-- jump Yahoo shop popup function -->
<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div id='hideMe'>
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title p-3 mb-2 bg-danger text-white">当店のYahooショップに移動中...</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            ＜＜ NEWS ＞＞ 当店Yahooショップは、ポイント割増中！
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
        
      </div>
    </div>
  </div>
</div>
<!-- end jump Yahoo shop popup function  -->
</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>

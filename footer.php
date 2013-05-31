 <footer>
        <p align="center"><?php echo $footer;?></p>
</footer>



<div id="about" class="modal hide fade">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">&times;</a>
				<h3>About <?php echo $storeName;?></h3>
			</div>
			<div class="modal-body" style="text-aligment: center;">
			<p>Certain content that appears on this Web Page comes from Amazon Services LLC. This content prvoided 'as is' and is subject to change or removal at any time.</p>
			<p>This Web Page serve the products as Amazon Associates.</p>
			<p>Product prices and availability are accurate and served realtime from Amazon Services. Any price and availability information displayed on Amazon.com at the time of purchase will apply to the purchase of this product.</p>
			</div>
			<div class="modal-footer">
                        <a href="#" class="btn" data-dismiss="modal">Close</a>
                        </div>
		</div>
		
<div id="privacy" class="modal hide fade">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">&times;</a>
				<h3>Privacy Policy</h3>
			</div>
			<div class="modal-body" style="text-aligment: center;">
			<p>We are committed to protecting your privacy. We will only use the information we collect about you lawfully (in accordance with the Data Protection Act 1998). Please read on if you wish to learn more about our privacy policy.</p>
<h4>What Information do we collect?</h4>

<p>We keep only the information about how you have navigated our website. We temporarily keep information on the products you have added to your basket. We do not keep any personal information that would identify you in the future. When processing your order at Amazon there are other details that will be required - see Amazon Privacy Policy for full details.</p>

<p>We also record usage data such as the pages visited. This information is completely anonymous.</p>

<p>Any information we hold is secured in accordance with our internal security policy.</p>

<h4>Do we use cookies?</h4>

<p>We use cookies to enable you to hold the content of your shopping basket between visits and to record anonymous traffic data. We do not store any personally identifying information in these cookies.</p>

<h4>Will we sell your information?</h4>

<p>We does not sell any information about their customers; as simple as that. We will not forward your details on to any third party at any time.</p>
			</div>
			<div class="modal-footer">
                        <a href="#" class="btn" data-dismiss="modal">Close</a>
                        </div>
		</div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.0.4/js/bootstrap.min.js"></script>
	<script src="http://twitter.github.com/bootstrap/1.4.0/bootstrap-popover.js"></script>
<?php if (!empty($viglink_api)) { ?>
<script type="text/javascript">
  var vglnk = { api_url: '//api.viglink.com/api',
                key: '<?php echo $viglink_api; ?>' };

  (function(d, t) {
    var s = d.createElement(t); s.type = 'text/javascript'; s.async = true;
    s.src = ('https:' == document.location.protocol ? vglnk.api_url :
             '//cdn.viglink.com/api') + '/vglnk.js';
    var r = d.getElementsByTagName(t)[0]; r.parentNode.insertBefore(s, r);
  }(document, 'script'));
</script>
<?php } ?>					
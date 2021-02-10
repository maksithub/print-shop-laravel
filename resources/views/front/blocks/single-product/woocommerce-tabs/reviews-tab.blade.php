<div id="reviews" class="electro-advanced-reviews">
	<div class="advanced-review row">
		<div class="col-xs-12 col-md-6">
			<div class="avg-rating">
				<span class="avg-rating-number">{{ number_format($product->getAvgScoreAttribute(), 1)}}</span> overall
			</div>
			<?php $allcount = $product->reviews->count();
			if($allcount == 0)
				$allcount = 1;
			?>

			<div class="rating-histogram">
				<div class="rating-bar">
					<div class="star-rating" title="Rated 5 out of 5">
						<span style="width:100%"></span>
					</div>
					<div class="rating-percentage-bar">
						<span style="width:$product->reviews->where('score', 5)->count() * 100 / $allcount %" class="rating-percentage">
						</span>
					</div>
					<div class="rating-count">{{ $product->reviews->where('score', 5)->count() }}</div>
				</div><!-- .rating-bar -->

				<div class="rating-bar">
					<div class="star-rating" title="Rated 4 out of 5">
						<span style="width:80%"></span>
					</div>
					<div class="rating-percentage-bar">
						<span style="width:{{$product->reviews->where('score', 4)->count() * 100 / $allcount}}%" class="rating-percentage"></span>
					</div>
					<div class="rating-count">{{ $product->reviews->where('score', 4)->count() }}</div>
				</div><!-- .rating-bar -->

				<div class="rating-bar">
					<div class="star-rating" title="Rated 3 out of 5">
						<span style="width:60%"></span>
					</div>
					<div class="rating-percentage-bar">
						<span style="width:$product->reviews->where('score', 3)->count() * 100 / $allcount%" class="rating-percentage"></span>
					</div>
					<div class="rating-count zero">{{ $product->reviews->where('score', 3)->count() }}</div>
				</div><!-- .rating-bar -->

				<div class="rating-bar">
					<div class="star-rating" title="Rated 2 out of 5">
						<span style="width:40%"></span>
					</div>
					<div class="rating-percentage-bar">
						<span style="width:$product->reviews->where('score', 2)->count() * 100 / $allcount%" class="rating-percentage"></span>
					</div>
					<div class="rating-count zero">{{ $product->reviews->where('score', 2)->count() }}</div>
				</div><!-- .rating-bar -->

				<div class="rating-bar">
					<div class="star-rating" title="Rated 1 out of 5">
						<span style="width:20%"></span>
					</div>
					<div class="rating-percentage-bar">
						<span style="width:$product->reviews->where('score', 1)->count() * 100 / $allcount%" class="rating-percentage"></span>
					</div>
					<div class="rating-count zero">{{ $product->reviews->where('score', 1)->count() }}</div>
				</div><!-- .rating-bar -->
			</div>
		</div><!-- /.col -->

		<div class="col-xs-12 col-md-6">
			<div id="review_form_wrapper">
				<div id="review_form">
					<div id="respond" class="comment-respond">
						<h3 id="reply-title" class="comment-reply-title">Add a review
							<small><a rel="nofollow" id="cancel-comment-reply-link" href="#" style="display:none;">Cancel reply</a>
							</small>
						</h3>

						<form action="/product/review" method="post" id="commentform" class="comment-form">
							{{ csrf_field() }}
							<p class="comment-form-rating">
								<label>Your Rating</label>
							</p>
							<p class="stars">

							  <fieldset class="starability-growRotate"> 
							    <input type="radio" id="rate5" name="rating" value="1" />
							    <label for="rate5" title="Terrible">5 stars</label>

							    <input type="radio" id="rate4" name="rating" value="2" />
							    <label for="rate4" title="Not good">4 stars</label>

							    <input type="radio" id="rate3" name="rating" value="3" />
							    <label for="rate3" title="Average">3 stars</label>

							    <input type="radio" id="rate2" name="rating" value="4" />
							    <label for="rate2" title="Very good">2 stars</label>

							    <input type="radio" id="rate1" name="rating" value="5" />
							    <label for="rate1" title="Amazing">1 star</label>
							  </fieldset>
							</p>

							<p class="comment-form-comment">
								<label for="comment">Your Review</label>
								<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
							</p>

							<p class="form-submit">
								<input name="submit" type="submit" id="submit" class="submit" value="Add Review" />
								<input type='hidden' name='comment_post_ID' value='2452' id='comment_post_ID' />
								<input type='hidden' name='comment_parent' id='comment_parent' value='{{$product->id}}' />
							</p>

							<input type="hidden" id="_wp_unfiltered_html_comment_disabled" name="_wp_unfiltered_html_comment_disabled" value="c7106f1f46" />
							<script>(function(){if(window===window.parent){document.getElementById('_wp_unfiltered_html_comment_disabled').name='_wp_unfiltered_html_comment';}})();</script>
						</form><!-- form -->
					</div><!-- #respond -->
				</div>
			</div>

		</div><!-- /.col -->
	</div><!-- /.row -->

	<div id="comments">

		<ol class="commentlist">

			@foreach($product->reviews as $review)

			<li class="comment odd alt thread-odd thread-alt depth-1">

				<div class="comment_container">

					<img alt='' src="assets/images/blog/avatar.jpg" class='avatar' height='60' width='60' />
					<div class="comment-text">

						<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating" title="Rated {{$review->score}} out of 5">
							<span style="width:{{$review->score * 20}}%"><strong itemprop="ratingValue">{{$review->rate}}</strong> out of 5</span>
						</div>

						<p class="meta">
							<strong>{{$review->author->name}}</strong> &ndash;
							<time itemprop="datePublished" datetime="2016-03-03T14:14:47+00:00">March 3, 2016</time>:
						</p>


						<div itemprop="description" class="description">
							<p>{{$review->body}}</p>
						</div>

						<p class="meta">
							<strong itemprop="author"> {{$review->author->name}} </strong> &ndash; <time itemprop="datePublished" datetime="{{$review->updated_at}}">{{$review->updated_at}}</time>
						</p>

					</div>
				</div>
			</li><!-- #comment-## -->
			@endforeach

		</ol><!-- /.commentlist -->

	</div><!-- /#comments -->

	<div class="clear"></div>
</div><!-- /.electro-advanced-reviews -->

@extends('layouts.visitor.main')

@section('content')
<div class="product-detail">
	<div class="card">
		<div class="card-body">
			<div class="card-content">
				<div class="row">
					<div class="col-md-5">
						<div class="align-items-center" style="max-height: 300px; overflow: hidden;">
							<!-- <div class="badge badge-success round position-absolute m-2">-50%</div> -->
							<img class="img-fluid mb-1" src="{{ $clinic->thumbnail_url }}" alt="Card image cap" width="100%">
						</div>
					</div>
					<div class="col-md-7">
						<div class="title-area clearfix">
							<h2 class="product-title float-left"><strong>{{ $clinic->title }}</strong></h2>
						</div>

						<!-- Product Information -->
						<div class="product-info">
							{!! html_entity_decode($clinic->description) !!}
						</div>

						<!-- Product facility-->
						<div class="row">
							<div class="col-sm-8">
									<i class="la la-wifi font-large-1 mr-1" data-toggle="tooltip" data-placement="top" data-original-title="Wifi"></i>
									<i class="la la-tv font-large-1 mr-1" data-toggle="tooltip" data-placement="top" data-original-title="Television"></i>
									<i class="la la-glass font-large-1 mr-1" data-toggle="tooltip" data-placement="top" data-original-title="Complimentary Drinks"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-content">
			<div class="card-body">
				<ul class="product-tabs nav nav-tabs nav-underline no-hover-bg">
					<li class="nav-item">
						<a class="nav-link active" id="description" data-toggle="tab" aria-controls="desc" href="#desc" aria-expanded="true">Dokter Bertugas</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="review" data-toggle="tab" aria-controls="ratings" href="#ratings" aria-expanded="false">Ratings</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="comments" data-toggle="tab" aria-controls="comment" href="#comment" aria-expanded="false">Komentar</a>
					</li>
				</ul>
				<div class="product-content tab-content px-1 pt-1">
					<div role="tabpanel" class="tab-pane active" id="desc" aria-expanded="true" aria-labelledby="description">
            @foreach($clinic->doctors->chunk(4) as $doctorGroup)
              @php
              $doctors = $doctorGroup->map(function ($clinicDoctor) {
                             return $clinicDoctor->doctor;
                         });
              @endphp
              @component('components.carousel-doctor', ['doctors' => $doctors]) @endcomponent
            @endforeach
					</div>
					<div class="tab-pane" id="ratings" aria-labelledby="review">
						<h2 class="my-1">Customer Rating &amp; Review</h2>
						<div class="media-list media-bordered">
							<div class="media">
								<span class="media-left">
									<img class="media-object" src="{{ asset('theme/modern-admin-1.0/app-assets/images/portrait/small/avatar-s-1.png') }}" alt="Generic placeholder image" style="width: 64px;height: 64px;">
								</span>
								<div class="media-body">
									<h5 class="media-heading mb-0 text-bold-600">
											Cookie candy
									</h5>
									<span class="ratings float-right" title="gorgeous"><img alt="1" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-on.png') }}" title="gorgeous">&nbsp;<img alt="2" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-on.png') }}" title="gorgeous">&nbsp;<img alt="3" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-on.png') }}" title="gorgeous">&nbsp;<img alt="4" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-on.png') }}" title="gorgeous">&nbsp;<img alt="5" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-half.png') }}" title="gorgeous"><input name="score" type="hidden" value="4.5" readonly=""></span>
									<div class="media-notation mb-1">
										2 Oct, 2018 at 8:39am
									</div>
									Tootsie roll chocolate cake oat cake. Cake topping sweet jelly beans gummies. Oat cake sugar plum cheesecake dragée bear claw chocolate cake dessert gummies chupa chups. Jujubes cake cotton candy danish gingerbread pastry tart danish tart. Gummies croissant icing tart. Sweet muffin marzipan danish. Lemon drops carrot cake carrot cake gummies. Oat cake wafer dessert. Chocolate jujubes jelly biscuit. Soufflé sweet cheesecake.
								</div>
							</div>
							<div class="media">
								<span class="media-left">
									<img class="media-object" src="{{ asset('theme/modern-admin-1.0/app-assets/images/portrait/small/avatar-s-8.png') }}" alt="Generic placeholder image" style="width: 64px;height: 64px;">
								</span>
								<div class="media-body">
									<h5 class="media-heading mb-0 text-bold-600">
										Tootsie roll dessert
									</h5>
									<span class="ratings float-right" title="gorgeous"><img alt="1" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-on.png') }}" title="gorgeous">&nbsp;<img alt="2" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-on.png') }}" title="gorgeous">&nbsp;<img alt="3" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-on.png') }}" title="gorgeous">&nbsp;<img alt="4" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-on.png') }}" title="gorgeous">&nbsp;<img alt="5" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-half.png') }}" title="gorgeous"><input name="score" type="hidden" value="4.5" readonly=""></span>
									<div class="media-notation mb-1">
										27 Sep, 2018 at 2:30pm
									</div>
									Pastry gummi bears jelly sweet. Pie gummi bears pastry chocolate danish powder oat cake bear claw. Marshmallow cake croissant. Cake lemon drops jelly beans marzipan pie carrot cake. Carrot cake ice cream donut. Chocolate jelly carrot cake tootsie roll chocolate chocolate cake. Soufflé donut sweet tootsie roll.
								</div>
							</div>
							<div class="media">
								<span class="media-left">
									<img class="media-object" src="{{ asset('theme/modern-admin-1.0/app-assets/images/portrait/small/avatar-s-6.png') }}" alt="Generic placeholder image" style="width: 64px;height: 64px;">
								</span>
								<div class="media-body">
									<h5 class="media-heading mb-0 text-bold-600">
										Lemon drops ice cream
									</h5>
									<span class="ratings float-right" title="gorgeous"><img alt="1" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-on.png') }}" title="gorgeous">&nbsp;<img alt="2" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-on.png') }}" title="gorgeous">&nbsp;<img alt="3" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-on.png') }}" title="gorgeous">&nbsp;<img alt="4" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-on.png') }}" title="gorgeous">&nbsp;<img alt="5" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-half.png') }}" title="gorgeous"><input name="score" type="hidden" value="4.5" readonly=""></span>
									<div class="media-notation mb-1">
										27 Jul, 2018 at 11:10am
									</div>
									Cookie lollipop caramels. Liquorice jelly beans icing chupa chups. Wafer brownie fruitcake sugar plum tiramisu. Jelly bear claw biscuit pie wafer. Croissant chupa chups cake. Tart dessert gingerbread cupcake. Ice cream jelly-o bonbon pudding chupa chups danish topping topping. Candy canes pastry wafer cheesecake brownie. Croissant donut bonbon candy sesame snaps candy canes sesame snaps wafer. Muffin candy croissant biscuit dragée.
								</div>
							</div>
						</div>
						<h2 class="my-1">Leave Your Review</h2>
						<form class="form">
							<div class="form-body">
								<label>Ratings</label>
								<div id="customer-review" class="mb-1" style="cursor: pointer;"><img alt="1" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-off.png') }}" title="bad">&nbsp;<img alt="2" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-off.png') }}" title="poor">&nbsp;<img alt="3" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-off.png') }}" title="regular">&nbsp;<img alt="4" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-off.png') }}" title="good">&nbsp;<img alt="5" src="{{ asset('theme/modern-admin-1.0/app-assets/images/raty/star-off.png') }}" title="gorgeous"><input name="score" type="hidden"></div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="name">Your Name</label>
											<input type="text" id="name" class="form-control" placeholder="Your Name" name="name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="subject">Subject</label>
											<input type="text" id="subject" class="form-control" placeholder="Subject" name="subject">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="review-desc">Your Review</label>
									<textarea id="review-desc" rows="5" class="form-control" name="comment" placeholder="Your Review"></textarea>
								</div>
								<button type="submit" class="btn btn-info">
									<i class="la la-check-square-o"></i> Submit Review
								</button>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="comment" aria-labelledby="comments">
						<h2 class="my-1">Comments</h2>
						<div class="media-list media-bordered">
							<div class="media">
								<span class="media-left">
									<img class="media-object" src="{{ asset('theme/modern-admin-1.0/app-assets/images/portrait/small/avatar-s-10.png') }}" alt="Generic placeholder image" style="width: 64px;height: 64px;">
								</span>
								<div class="media-body">
									<h5 class="media-heading mb-0 text-bold-600">
										Fruitcake apple pie
									</h5>
									<div class="media-notation mb-1">
										20 Sep, 2018 at 7:37pm
									</div>
									Cupcake ice cream cake cotton candy gummi bears cotton candy macaroon chocolate. Cake croissant tiramisu dragée marshmallow halvah tiramisu. Gummi bears soufflé pudding. Donut muffin brownie brownie. Liquorice sweet roll chocolate cake tootsie roll fruitcake. Jujubes bonbon cake chocolate bar liquorice pastry dessert. Fruitcake apple pie pie caramels sweet roll. Jelly icing jujubes soufflé.
								</div>
							</div>
							<div class="media">
								<span class="media-left">
									<img class="media-object" src="{{ asset('theme/modern-admin-1.0/app-assets/images/portrait/small/avatar-s-12.png') }}" alt="Generic placeholder image" style="width: 64px;height: 64px;">
								</span>
								<div class="media-body">
									<h5 class="media-heading mb-0 text-bold-600">
										Tiramisu cupcake
									</h5>
									<div class="media-notation mb-1">
										7 Aug, 2018 at 10:48am
									</div>
									Brownie cotton candy topping chocolate cake danish dragée soufflé jujubes powder. Toffee tart carrot cake donut. Macaroon apple pie sweet roll sweet toffee sweet. Pastry powder croissant candy canes jelly beans macaroon macaroon donut. Jelly beans ice cream marshmallow. Tiramisu cupcake pudding sesame snaps. Jelly-o caramels gummies candy canes apple pie chupa chups jelly macaroon sweet roll.
								</div>
							</div>
							<div class="media">
								<span class="media-left">
									<img class="media-object" src="{{ asset('theme/modern-admin-1.0/app-assets/images/portrait/small/avatar-s-7.png') }}" alt="Generic placeholder image" style="width: 64px;height: 64px;">
								</span>
								<div class="media-body">
									<h5 class="media-heading mb-0 text-bold-600">
										Caramels marshmallow
									</h5>
									<div class="media-notation mb-1">
										19 Jun, 2018 at 1:11pm
									</div>
									Jelly dragée pie carrot cake caramels marshmallow. Wafer croissant wafer cookie liquorice. Candy canes soufflé brownie jelly macaroon wafer gummies cotton candy danish. Soufflé sweet carrot cake halvah liquorice jujubes. Sweet chocolate carrot cake. Liquorice donut biscuit soufflé. Brownie sweet roll dragée apple pie soufflé cheesecake. Biscuit jelly carrot cake danish pudding dessert biscuit cake fruitcake. Jelly toffee cotton candy lemon drops ice cream chocolate cake. Marzipan powder gummies.
								</div>
							</div>
						</div>
						<h2 class="my-1">Leave Comment</h2>
						<form class="form">
							<div class="form-body">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="leave-name">Name</label>
											<input type="text" id="leave-name" class="form-control" placeholder="Name" name="name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="leave-subject">Subject</label>
											<input type="text" id="leave-subject" class="form-control" placeholder="Subject" name="lname">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="leave-review-desc">Your Comment</label>
									<textarea id="leave-review-desc" rows="5" class="form-control" name="comment" placeholder="Your Comment"></textarea>
								</div>
								<button type="submit" class="btn btn-info">
									<i class="la la-check"></i> Submit
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('footer')
  @include('layouts.visitor.footer-complete')
  @parent
@endsection

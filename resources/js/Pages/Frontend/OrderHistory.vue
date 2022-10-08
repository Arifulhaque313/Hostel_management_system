<template>
	<Head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>Order History</title>
	</Head>

	<AppLayout>
		<section class="container mx-auto px-4 sm:px-0 py-6">
			<!-- <div v-if="$page.props.flash.success" class="text-center mb-2" id="successMessage">
        {{$page.props.flash.success}}
        </div> -->
			<div v-if="$page.props.flash.success" id="successMessage" class="bg-green-100 text-center relative flex flex-col sm:flex-row sm:items-center bg-white shadow rounded-md py-5 pl-6 pr-8 sm:pr-6">
				<div class="flex flex-row items-center border-b sm:border-b-0 w-full sm:w-auto pb-4 sm:pb-0">
					<div class="text-green-500">
						<svg class="w-6 sm:w-5 h-6 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
					</div>
					<div class="text-sm font-medium ml-3">{{ $page.props.flash.success }}</div>
				</div>
				<div class="text-sm tracking-wide text-gray-500 mt-4 sm:mt-0 sm:ml-4">Thank you for your purchase!</div>
				<div class="absolute sm:relative sm:top-auto sm:right-auto ml-auto right-4 top-4 text-gray-400 hover:text-gray-800 cursor-pointer">
					<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
				</div>
			</div>
			<div v-if="!orders[0]" class="items-center">
				<div class="mt-4 sm:mt-20 flex flex-col justify-center items-center">
					<img src="/images/notfound.png" alt="not found" />
					<h1 class="mt-4 flex flex-col justify-center items-center space-y-2">
						<span class="text-xl font-extrabold text-red-500">No Orders Found</span>
					</h1>
				</div>
			</div>
			<div v-else class="flex flex-col-reverse items-center sm:items-start sm:grid grid-cols-7 gap-4 justify-center py-4 sm:py-6">
				<div class="col-span-3 space-y-2 w-full">
					<section class="text-gray-600 body-font">
						<div class="container px-5 py-5 mx-auto">
							<div class="text-center mb-2">
								<h1 class="sm:text-3xl text-2xl font-medium text-left title-font text-gray-900 mb-4">My Orders</h1>
							</div>
							<div class="flex flex-wrap lg:w-4/5 sm:mx-auto sm:mb-2 -mx-2">
								<div v-for="(order, index) in orders" :key="index" @click="orderDetails(order)" class="p-2 sm:w-full w-full">
									<div class="bg-gray-100 rounded">
										<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" class="text-brandColor w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
											<path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
											<path d="M22 4L12 14.01l-3-3"></path>
										</svg>
										<div class="single-colmn-per-order selected-item">
											<div class="card-header-area px-2 py-3">
												<h2 class="d-inline-block">Order#{{ order.id }}</h2>
												<span class="mb-3 float-right gray gray--text"
													><span class="text-brandColorNew">{{ order.status.title }} </span></span
												>
											</div>
											<hr role="separator" aria-orientation="horizontal" class="v-divider theme--light" />
											<div class="my-order px-2 py-3">
												<div class="d-flex justify-space-between align-center">
													<p class="mb-0">Order Date:</p>
													<p class="mb-0">{{ order.created_at }}</p>
												</div>
												<div class="d-flex justify-space-between align-center pt-2">
													<p class="mb-0 font-weight-bold">Total Price:</p>
													<p class="mb-0 font-weight-bold">{{ order.amount.toFixed(2) }}</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-span-4 space-y-2 w-full">
					<div class="row text-gray-600 body-font">
						<div class="pb-0 col col-12">
							<div v-if="currentRoute == '/my-orders'" class="grid grid-cols-1 gap-3">
								<div class="p-4 col-span-1">
									<h1>Orders Details (#{{ orders[0].id }} )</h1>
								</div>
								<div class="p-2 relative right-0 mb-2 col-span-1">
									<!-- <button v-if="orders[0].payment != 'paid'" type="button" @click="openModel(orders[0].id)"
                    class="right-0 px-2 py-2  bg-green-500 text-white"><span
                        class="v-btn__content"> Pay Now
                    </span></button> -->

									<Link :href="route('order.payment', {id: orders[0].id})" > 
										<button class="right-0 px-2 py-2 bg-green-500 text-white"> Pay Now </button>
									</Link>

									<button v-if="orders[0].status.title == 'Pending'" type="button" @click="cancelOrderModal(orders[0].id)" class="ml-4 right-0 px-2 py-2 bg-red-500 text-white">Cancel Order</button>
								</div>
							</div>
							<div v-else class="grid grid-cols-1 gap-3">
								<div v-for="(order, index) in orders.filter((d) => d.id === currentRoute)" :key="index">
									<div class="p-4 col-span-1">
										<h1>Orders Details (#{{ order.id }} )</h1>
									</div>
									<div class="p-2 relative right-0 mb-2 col-span-1">
										<Link :href="route('order.payment', {id: order.id})"> 
											<button class="right-0 px-2 py-2 bg-green-500 text-white"> Pay Now </button>

										</Link>
										<!-- <a v-if="order.payment != 'paid'" :href="route('payment.ssl', {type: 'product', id: order.id})" class="button right-0 px-2 py-2  bg-green-500 text-white"> Pay now</a> -->
										<button v-if="order.status.title == 'Pending'" type="button" @click="cancelOrderModal(order.id)" class="ml-4 right-0 px-2 py-2 bg-red-500 text-white"><span class="v-btn__content">Cancel Order </span></button>
									</div>
								</div>
							</div>
							<hr role="separator" aria-orientation="horizontal" class="v-divider theme--light" />
						</div>
						<div class="col col-12">
							<div class="row px-3">
								<div class="action-area-order xs-6 px-3 pt-3 col-sm-8 col-md-8 col-lg-8 col">
									<div class="d-flex justify-space-between align-center mb-2">
										<h3>Delivery Address</h3>
									</div>
									<div v-if="currentRoute == '/my-orders'">
										<p class="mb-2">{{ orders[0].address }}</p>
									</div>
									<div v-else v-for="(order, index) in orders.filter((d) => d.id === currentRoute)" :key="index">
										<p class="mb-2">{{ order.address }}</p>
									</div>

									<!---->
									<div class="d-flex mt-8">
										<!---->
										<!---->
									</div>
								</div>
								<hr role="separator" aria-orientation="vertical" class="v-divider v-divider--vertical theme--light" />
								<div class="xs-6 col-sm-4 col-md-4 col-lg-4 col">
									<div v-if="currentRoute == '/my-orders'">
										<h3 v-if="orders[0].payment == 'unpaid'" class="text-right mb-2 text-red-600">
											{{ orders[0].payment }}
										</h3>
										<h3 v-else class="text-right mb-2 text-green-600">
											paid
										</h3>
									</div>
									<div v-else v-for="(order, index) in orders.filter((d) => d.id === currentRoute)" :key="index">
										<h3 v-if="order.payment == 'unpaid'" class="text-right mb-2 text-red-600">
											{{ order.payment }}
										</h3>
										<h3 v-else class="text-right mb-2 text-green-600">
											paid
										</h3>
									</div>
									<div class="d-flex justify-space-between align-center mb-2">
										<p>Sub Total</p>
										<div v-if="currentRoute == '/my-orders'">
											<p>{{ orders[0].amount.toFixed(2) }}</p>
										</div>
										<div v-else v-for="(order, index) in orders.filter((d) => d.id === currentRoute)" :key="index">
											<p>{{ order.amount.toFixed(2)}}</p>
										</div>
									</div>
									<div class="d-flex justify-space-between align-center mb-2">
										<p>Delivery Fee</p>
										<div v-if="currentRoute == '/my-orders'">
											<p>{{ orders[0].shipping_cost.toFixed(2) }}</p>
										</div>
										<div v-else v-for="(order, index) in orders.filter((d) => d.id === currentRoute)" :key="index">
											<p>{{ order.shipping_cost.toFixed(2) }}</p>
										</div>
									</div>
									<hr role="separator" aria-orientation="horizontal" class="v-divider theme--light" />
									<div class="d-flex justify-space-between align-center mt-2">
										<p class="font-weight-bold">Total</p>
										<div v-if="currentRoute == '/my-orders'">
											<p class="font-weight-bold">{{ ((orders[0].amount) + (orders[0].shipping_cost)).toFixed(2) }}</p>
										</div>
										<div v-else v-for="(order, index) in orders.filter((d) => d.id === currentRoute)" :key="index">
											<p class="font-weight-bold">{{ ((order.amount) + (orders[0].shipping_cost)).toFixed(2) }}</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="pt-0 col col-12">
							<hr role="separator" aria-orientation="horizontal" class="v-divider theme--light" />
							<!-- START FOR DEFAULT SELECTED LATEST ORDER -->
							<nav v-if="currentRoute == '/my-orders'" aria-label="Progress">
								<ol role="list" class="border border-gray-300 rounded-md divide-y divide-gray-300 md:flex md:divide-y-0">
									<li class="relative md:flex-1 md:flex">
										<!-- Completed Step -->
										<a v-if="orders[0].status.code == 1" href="#" class="group flex items-center w-full">
											<span class="px-6 py-4 flex items-center text-sm font-medium">
												<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-yellow-500 rounded-full group-hover:bg-yellow-500">
													<!-- Heroicon name: solid/check -->
													<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
													</svg>
												</span>
												<span class="ml-4 text-sm font-medium text-gray-900">Pending</span>
											</span>
										</a>
										<a v-else href="#" class="px-6 py-4 flex items-center text-sm font-medium" aria-current="step">
											<span v-if="orders[0].status.code > 1" class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-green-500 rounded-full group-hover:bg-green-500">
												<!-- Heroicon name: solid/check -->
												<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
													<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
												</svg>
											</span>
											<span v-else class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-brandColor rounded-full">
												<span class="text-brandColor">01</span>
											</span>
											<span class="ml-4 text-sm font-medium text-brandColor">Pending</span>
										</a>

										<!-- Arrow separator for lg screens and up -->
										<div class="hidden md:block absolute top-0 right-0 h-full w-5" aria-hidden="true">
											<svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
												<path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
											</svg>
										</div>
									</li>

									<li class="relative md:flex-1 md:flex">
										<!-- Current Step -->
										<a v-if="orders[0].status.code == 2" href="#" class="group flex items-center w-full">
											<span class="px-6 py-4 flex items-center text-sm font-medium">
												<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-yellow-500 rounded-full group-hover:bg-yellow-500">
													<!-- Heroicon name: solid/check -->
													<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
													</svg>
												</span>
												<span class="ml-4 text-sm font-medium text-gray-900">Processing</span>
											</span>
										</a>
										<a v-else href="#" class="px-6 py-4 flex items-center text-sm font-medium" aria-current="step">
											<span v-if="orders[0].status.code > 2" class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-green-500 rounded-full group-hover:bg-green-500">
												<!-- Heroicon name: solid/check -->
												<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
													<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
												</svg>
											</span>
											<span v-else class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-brandColor rounded-full">
												<span class="text-brandColor">02</span>
											</span>
											<span class="ml-4 text-sm font-medium text-brandColor">Processing</span>
										</a>

										<!-- Arrow separator for lg screens and up -->
										<div class="hidden md:block absolute top-0 right-0 h-full w-5" aria-hidden="true">
											<svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
												<path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
											</svg>
										</div>
									</li>

									<li class="relative md:flex-1 md:flex">
										<!-- Upcoming Step -->
										<a v-if="orders[0].status.code == 3" href="#" class="group flex items-center w-full">
											<span class="px-6 py-4 flex items-center text-sm font-medium">
												<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-yellow-500 rounded-full group-hover:bg-yellow-500">
													<!-- Heroicon name: solid/check -->
													<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
													</svg>
												</span>
												<span class="ml-4 text-sm font-medium text-gray-900">Confirmed</span>
											</span>
										</a>
										<a v-else href="#" class="px-6 py-4 flex items-center text-sm font-medium" aria-current="step">
											<span v-if="orders[0].status.code > 3" class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-green-500 rounded-full group-hover:bg-green-500">
												<!-- Heroicon name: solid/check -->
												<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
													<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
												</svg>
											</span>
											<span v-else class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-brandColor rounded-full">
												<span class="text-brandColor">03</span>
											</span>
											<span class="ml-4 text-sm font-medium text-brandColor">Confirmed</span>
										</a>
									</li>
									<li class="relative md:flex-1 md:flex">
										<!-- Upcoming Step -->
										<a v-if="orders[0].status.code == 4" href="#" class="group flex items-center w-full">
											<span class="px-6 py-4 flex items-center text-sm font-medium">
												<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-yellow-500 rounded-full group-hover:bg-yellow-500">
													<!-- Heroicon name: solid/check -->
													<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
													</svg>
												</span>
												<span class="ml-4 text-sm font-medium text-gray-900">Delivered</span>
											</span>
										</a>
										<a v-else href="#" class="px-6 py-4 flex items-center text-sm font-medium" aria-current="step">
											<span v-if="orders[0].status.code > 4" class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-green-500 rounded-full group-hover:bg-green-500">
												<!-- Heroicon name: solid/check -->
												<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
													<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
												</svg>
											</span>
											<span v-else class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-brandColor rounded-full">
												<span class="text-brandColor">03</span>
											</span>
											<span class="ml-4 text-sm font-medium text-brandColor">Delivered</span>
										</a>
									</li>
								</ol>
							</nav>
							<!-- END FOR DEFAULT SELECTED LATEST ORDER -->
							<!-- START FOR SELECTED ORDER -->
							<nav v-else v-for="(order, index) in orders.filter((d) => d.id === currentRoute)" :key="index" aria-label="Progress">
								<ol role="list" class="border border-gray-300 rounded-md divide-y divide-gray-300 md:flex md:divide-y-0">
									<li class="relative md:flex-1 md:flex">
										<!-- Completed Step -->
										<a v-if="order.status.code == 1" href="#" class="group flex items-center w-full">
											<span class="px-6 py-4 flex items-center text-sm font-medium">
												<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-yellow-500 rounded-full group-hover:bg-yellow-500">
													<!-- Heroicon name: solid/check -->
													<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
													</svg>
												</span>
												<span class="ml-4 text-sm font-medium text-gray-900">Pending</span>
											</span>
										</a>
										<a v-else href="#" class="px-6 py-4 flex items-center text-sm font-medium" aria-current="step">
											<span v-if="order.status.code > 1" class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-green-500 rounded-full group-hover:bg-green-500">
												<!-- Heroicon name: solid/check -->
												<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
													<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
												</svg>
											</span>
											<span v-else class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-brandColor rounded-full">
												<span class="text-brandColor">01</span>
											</span>
											<span class="ml-4 text-sm font-medium text-brandColor">Pending</span>
										</a>

										<!-- Arrow separator for lg screens and up -->
										<div class="hidden md:block absolute top-0 right-0 h-full w-5" aria-hidden="true">
											<svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
												<path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
											</svg>
										</div>
									</li>

									<li class="relative md:flex-1 md:flex">
										<!-- Current Step -->
										<a v-if="order.status.code == 2" href="#" class="group flex items-center w-full">
											<span class="px-6 py-4 flex items-center text-sm font-medium">
												<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-yellow-500 rounded-full group-hover:bg-yellow-500">
													<!-- Heroicon name: solid/check -->
													<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
													</svg>
												</span>
												<span class="ml-4 text-sm font-medium text-gray-900">Processing</span>
											</span>
										</a>
										<a v-else href="#" class="px-6 py-4 flex items-center text-sm font-medium" aria-current="step">
											<span v-if="order.status.code > 2" class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-green-500 rounded-full group-hover:bg-green-500">
												<!-- Heroicon name: solid/check -->
												<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
													<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
												</svg>
											</span>
											<span v-else class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-brandColor rounded-full">
												<span class="text-brandColor">02</span>
											</span>
											<span class="ml-4 text-sm font-medium text-brandColor">Processing</span>
										</a>

										<!-- Arrow separator for lg screens and up -->
										<div class="hidden md:block absolute top-0 right-0 h-full w-5" aria-hidden="true">
											<svg class="h-full w-full text-gray-300" viewBox="0 0 22 80" fill="none" preserveAspectRatio="none">
												<path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentcolor" stroke-linejoin="round" />
											</svg>
										</div>
									</li>

									<li class="relative md:flex-1 md:flex">
										<!-- Upcoming Step -->
										<a v-if="order.status.code == 3" href="#" class="group flex items-center w-full">
											<span class="px-6 py-4 flex items-center text-sm font-medium">
												<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-yellow-500 rounded-full group-hover:bg-yellow-500">
													<!-- Heroicon name: solid/check -->
													<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
													</svg>
												</span>
												<span class="ml-4 text-sm font-medium text-gray-900">Confirmed</span>
											</span>
										</a>
										<a v-else href="#" class="px-6 py-4 flex items-center text-sm font-medium" aria-current="step">
											<span v-if="order.status.code > 3" class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-green-500 rounded-full group-hover:bg-green-500">
												<!-- Heroicon name: solid/check -->
												<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
													<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
												</svg>
											</span>
											<span v-else class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-brandColor rounded-full">
												<span class="text-brandColor">03</span>
											</span>
											<span class="ml-4 text-sm font-medium text-brandColor">Confirmed</span>
										</a>
									</li>
									<li class="relative md:flex-1 md:flex">
										<!-- Upcoming Step -->
										<a v-if="order.status.code == 4" href="#" class="group flex items-center w-full">
											<span class="px-6 py-4 flex items-center text-sm font-medium">
												<span class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-yellow-500 rounded-full group-hover:bg-yellow-500">
													<!-- Heroicon name: solid/check -->
													<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
														<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
													</svg>
												</span>
												<span class="ml-4 text-sm font-medium text-gray-900">Delivered</span>
											</span>
										</a>
										<a v-else href="#" class="px-6 py-4 flex items-center text-sm font-medium" aria-current="step">
											<span v-if="order.status.code > 4" class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-green-500 rounded-full group-hover:bg-green-500">
												<!-- Heroicon name: solid/check -->
												<svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
													<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
												</svg>
											</span>
											<span v-else class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 border-brandColor rounded-full">
												<span class="text-brandColor">03</span>
											</span>
											<span class="ml-4 text-sm font-medium text-brandColor">Delivered</span>
										</a>
									</li>
								</ol>
							</nav>
							<!-- END FOR SELECTED ORDER -->
						</div>
					</div>
					<div class="flex flex-col">
						<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
							<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
								<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
									<table class="min-w-full divide-y divide-gray-200">
										<thead class="bg-brandColorNew">
											<tr>
												<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Name</th>
												<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Quantity</th>
												<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Price</th>
												<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Discount</th>
												<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Total</th>
											</tr>
										</thead>
										<tbody v-show="currentRoute == '/my-orders'" class="bg-white divide-y divide-gray-200">
											<tr v-for="(item, index) in orders[0].items" :key="index" class="text-gray-500">
												<td class="px-6 py-4 whitespace-nowrap">
													{{ item.product.name }}
												</td>
												<td class="px-6 py-4 whitespace-nowrap">
													{{ item.quantity }}
												</td>
												<td v-if="item.product.discount_type == 'percentage'" class="px-6 py-4 whitespace-nowrap">{{ ((item.product.price - (item.product.price * item.product.discount) / 100)).toFixed(2) }} $</td>
												<td v-else-if="item.product.discount_type == 'flat'" class="px-6 py-4 whitespace-nowrap">{{ ((item.product.price - item.product.discount)).toFixed(2) }} $</td>
												<td v-else class="px-6 py-4 whitespace-nowrap">{{ item.product.price }} $</td>

												<td v-if="item.product.discount_type == 'percentage'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ item.product.discount }} %</td>

												<td v-if="item.product.discount_type == 'flat'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
													{{ item.product.discount }}
												</td>
												<td v-if="item.product.discount_type == 'percentage'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ((item.product.price - (item.product.price * item.product.discount) / 100) * (item.quantity)).toFixed(2) }}$</td>
												<td v-else-if="item.product.discount_type == 'flat'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ((item.product.price - item.product.discount) *(item.quantity)).toFixed(2) }} $</td>
												<td v-else class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ (item.product.price) * (item.quantity) }} $</td>
											</tr>
										</tbody>
										<tbody v-show="currentRoute != '/my-orders'" v-for="(order, index) in orders.filter((d) => d.id === currentRoute)" :key="index" class="bg-white divide-y divide-gray-200">
											<tr v-for="(item, index) in order.items" :key="index" class="text-gray-500">
												<td class="px-6 py-4 whitespace-nowrap">
													{{ item.product.name }}
												</td>
												<td class="px-6 py-4 whitespace-nowrap">
													{{ item.quantity }}
												</td>
												<td v-if="item.product.discount_type == 'percentage'" class="px-6 py-4 whitespace-nowrap">{{ ((item.product.price - (item.product.price * item.product.discount) / 100)) .toFixed(2) }} $</td>
												<td v-else-if="item.product.discount_type == 'flat'" class="px-6 py-4 whitespace-nowrap">{{ ((item.product.price - item.product.discount)).toFixed(2) }} $</td>
												<td v-else class="px-6 py-4 whitespace-nowrap">{{ item.product.price }} $</td>

												<td v-if="item.product.discount_type == 'percentage'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ item.product.discount }} %</td>

												<td v-if="item.product.discount_type == 'flat'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
													{{ item.product.discount }}
												</td>
												<td v-if="item.product.discount_type == 'percentage'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ (item.product.price - (item.product.price * item.product.discount) / 100) * (item.quantity) .toFixed(2)}} $</td>
												<td v-else-if="item.product.discount_type == 'flat'" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ (item.product.price - item.product.discount) * (item.quantity) .toFixed(2)}} $</td>
												<td v-else class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ (item.product.price) * (item.quantity) }} $</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<TransitionRoot as="template" :show="open">
			<Dialog as="div" static class="fixed z-10 inset-0 overflow-y-auto" @close="open = false" :open="open">
				<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
					<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
						<DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
					</TransitionChild>

					<!-- This element is to trick the browser into centering the modal contents. -->
					<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
					<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
						<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
							<div v-if="currentRoute == '/my-orders'" class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
								<a class="button mt-3 items-center w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" :href="route('payment.ssl', {type: 'product', id: orders[0].id})">
									<img src="/images/sslcommerz.png" alt="sslcommerz" />
								</a>
								<a class="button mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" :href="route('stripe', {type: 'product', id: orders[0].id})" ref="cancelButtonRef">
									<img src="/images/stripe.png" alt="stripe" />
								</a>
							</div>
							<div v-else v-for="(order, index) in orders.filter((d) => d.id === currentRoute)" :key="index" class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
								<a class="button mt-3 items-center w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" :href="route('payment.ssl', {type: 'product', id: order.id})">
									<img src="/images/sslcommerz.png" alt="sslcommerz" />
								</a>
								<a type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" :href="route('stripe', {type: 'product', id: order.id})" ref="cancelButtonRef">
									<img src="/images/stripe.png" alt="stripe" />
								</a>
							</div>
						</div>
					</TransitionChild>
				</div>
			</Dialog>
		</TransitionRoot>

		<TransitionRoot as="template" :show="opencancel">
			<Dialog as="div" static class="fixed z-10 inset-0 overflow-y-auto" @close="opencancel = false" :open="opencancel">
				<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
					<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
						<DialogOverlay class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" />
					</TransitionChild>

					<!-- This element is to trick the browser into centering the modal contents. -->
					<span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
					<TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to="opacity-100 translate-y-0 sm:scale-100" leave="ease-in duration-200" leave-from="opacity-100 translate-y-0 sm:scale-100" leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
						<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
							<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
								<div class="sm:flex sm:items-start">
									<div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
										<ExclamationIcon class="h-6 w-6 text-red-600" aria-hidden="true" />
									</div>
									<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
										<DialogTitle as="h3" class="text-lg leading-6 font-medium text-gray-900">Cancel Order?</DialogTitle>
										<div class="mt-2">
											<p class="text-sm text-gray-500">Are you sure you want to cancel this order? This action cannot be undone.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
								<button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm" @click="cancelOrder()">Cancel Order</button>
								<button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" @click="opencancel = false" ref="cancelButtonRef">Cancel</button>
							</div>
						</div>
					</TransitionChild>
				</div>
			</Dialog>
		</TransitionRoot>
	</AppLayout>
</template>

<script>
import AppLayout from "../../Layouts/FrontEnd/AppLayout.vue"
import {Link, Head} from "@inertiajs/inertia-vue3"
import {Inertia} from "@inertiajs/inertia"
import {ref, reactive, watch} from "vue"
import {Dialog, DialogOverlay, DialogTitle, TransitionChild, TransitionRoot} from "@headlessui/vue"
import {UserGroupIcon, MenuIcon, BanIcon, BadgeCheckIcon, EyeIcon, QuestionMarkCircleIcon, CollectionIcon, TrashIcon, ExclamationIcon, SearchIcon, PencilAltIcon} from "@heroicons/vue/outline"
export default {
	mounted() {
		window.setTimeout("document.getElementById('successMessage').style.display='none';", 5000)
	},
	name: "App",
	metaInfo: {title: "Home"},
	components: {
		AppLayout,
		Head,
		Link,
		Dialog,
		DialogOverlay,
		DialogTitle,
		TransitionChild,
		TransitionRoot,
		ExclamationIcon,
		SearchIcon,
		PencilAltIcon,
		UserGroupIcon,
		MenuIcon,
		BanIcon,
		BadgeCheckIcon,
		EyeIcon,
		QuestionMarkCircleIcon,
		CollectionIcon,
		TrashIcon,
	},
	props: {
		orders: Array,
	},
	setup(props) {
		var choosenorder = []
		var currentRoute = window.location.pathname
		const open = ref(false)
		const opencancel = ref(false)
		const order_id = ref(null)
		function openModel(id) {
			order_id.value = id
			open.value = true
		}
		function cancelOrderModal(id) {
			order_id.value = id
			opencancel.value = true
		}
		function cancelOrder() {
			Inertia.put(
				route("order.update.cancel", order_id.value),
				{
					orderid: order_id.value,
					preserveState: true,
					preserveScroll: true,
				},
				{
					onSuccess: (page) => {
						opencancel.value = false
					},
				}
			)
		}
		function selectedOrder() {
			return props.orders.find((d) => d.id === currentRoute)
		}

		return {currentRoute, choosenorder, open, opencancel, openModel, cancelOrderModal, cancelOrder, selectedOrder}
	},

	methods: {
		orderDetails(order) {
			this.currentRoute = order.id
			this.loading = true
			this.$inertia
				.visit(route("order.index", order.id), {
					replace: true,
					preserveState: true,
					preserveScroll: true,
				})
				.then(() => {
					this.loading = false
				})
		},
	},
}
</script>

<style></style>

@extends('admin_dashboard.layout.master')
@section('Page_Title')  محركات البحث @endsection

@section('content')


    <div class="card">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <h5 class="mb-0"> <i class="bi bi-grid-fill"></i>  محركات البحث </h5>
            </div>

            <form class="row g-3 mt-5" id="validateForm" method="post" enctype="multipart/form-data"
                      action="{{route('seos.update', $content->id)}}">
                    @method('put')
                    @csrf


                <div class="col-md-12">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        العنوان <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr"> < meta name="title" content="{{$content->meta_title ?? ''}}"></small>  </label>
                    <input type="text" class="form-control" name="meta_title" value="{{$content->meta_title ?? ''}}" />
                </div>
                <div class="col-md-12">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        الكلمات الدلالية <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr"> < meta name="keywords" content="{{$content->keywords ?? ''}}"></small>  </label>
                    <input type="text" class="form-control" name="keywords" value="{{$content->keywords ?? ''}}" />
                </div>
                <div class="col-md-12">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        الوصف <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr"> < meta name="description" content="{{$content->meta_description ?? ''}}"></small>  </label>
                    <input type="text" class="form-control" name="meta_description" value="{{$content->meta_description ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        المؤلف / الناشر  <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr"> < meta name="author" content="{{$content->author ?? ''}}"></small>  </label>
                    <input type="text" class="form-control" name="author" value="{{$content->author ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        نوع الأبلكيشن (Website is Default) <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr"> < meta property="og:type" content="{{$content->og_type ?? ''}}"></small>  </label>
                    <input type="text" class="form-control" name="og_type" value="{{$content->og_type ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        الرابط الأساسي <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr"> < meta property="og:url" content="{{$content->og_url ?? ''}}"></small>  </label>
                    <input type="text" class="form-control" name="og_url" value="{{$content->og_url ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        العنوان <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr"> < meta property="og:title" content="{{$content->og_title ?? ''}}"></small>  </label>
                    <input type="text" class="form-control" name="og_title" value="{{$content->og_title ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        الوصف <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr"> < meta property="og:description" content="{{$content->og_description ?? ''}}"></small>  </label>
                    <input type="text" class="form-control" name="og_description" value="{{$content->og_description ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        اسم الموقع <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr"> < meta property="og:site_name" content="{{$content->og_site_name ?? ''}}"></small>  </label>
                    <input type="text" class="form-control" name="og_site_name" value="{{$content->og_site_name ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        رابط كانونيكال (canonical) <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr">  < link rel ="canonical" href ="{{$content->canonical ?? ''}}"></small>  </label>
                    <input type="text" class="form-control" name="canonical" value="{{$content->canonical ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        رابط الصورة الأساسية <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr">  < link rel ="image_src" href ="{{$content->image_src ?? ''}}"></small>  </label>
                    <input type="text" class="form-control" name="image_src" value="{{$content->image_src ?? ''}}" />
                    <input type="hidden" class="form-control" name="og_image" value="{{$content->image_src ?? ''}}" />
                    <input type="hidden" class="form-control" name="og_image_url" value="{{$content->image_src ?? ''}}" />
                    <input type="hidden" class="form-control" name="itemprop_image" value="{{$content->image_src ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        اسم المجال <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr">  < meta itemprop="name" content="{{$content->itemprop_name ?? ''}}" /></small>  </label>
                    <input type="text" class="form-control" name="itemprop_name" value="{{$content->itemprop_name ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        عنوان تويتر <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr">  < meta name="twitter:title" content="{{$content->twitter_title ?? ''}}" /></small>  </label>
                    <input type="text" class="form-control" name="twitter_title" value="{{$content->twitter_title ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        رابط تويتر <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr">  < meta name="twitter:url" content="{{$content->twitter_url ?? ''}}" /></small>  </label>
                    <input type="text" class="form-control" name="twitter_url" value="{{$content->twitter_url ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        كارت تويتر <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr">  < meta name="twitter:card" content="{{$content->twitter_card ?? ''}}" /></small>  </label>
                    <input type="text" class="form-control" name="twitter_card" value="{{$content->twitter_card ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        رابط تويتر <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr">  < meta name="twitter:site" content="{{$content->twitter_site ?? ''}}" /></small>  </label>
                    <input type="text" class="form-control" name="twitter_site" value="{{$content->twitter_site ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        وصف تويتر <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr">  < meta name="twitter:description" content="{{$content->twitter_description ?? ''}}" /></small>  </label>
                    <input type="text" class="form-control" name="twitter_description" value="{{$content->twitter_description ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                         الناشر تويتر <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr">  < meta name="twitter:creator" content="{{$content->twitter_creator ?? ''}}" /></small>  </label>
                    <input type="text" class="form-control" name="twitter_creator" value="{{$content->twitter_creator ?? ''}}" />
                </div>
                <div class="col-md-6">
                    <label class="form-label d-flex align-items-center justify-content-between">
                        رابط الصورة تويتر <small class="text-danger fw-bold" style="float: left;word-break: break-all;" dir="ltr">  < meta name="twitter:image" content="{{$content->twitter_image ?? ''}}" /></small>  </label>
                    <input type="text" class="form-control" name="twitter_image" value="{{$content->twitter_image ?? ''}}" />
                </div>

                <div class="row bg-light my-4 p-3">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label d-flex align-items-center justify-content-between">اسم مايكروداتا</label>
                                <input type="text" class="form-control" name="microdata_name" value="{{$content->microdata_name ?? ''}}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label d-flex align-items-center justify-content-between">نوع مايكروداتا</label>
                                <input type="text" class="form-control" name="microdata_type" value="{{$content->microdata_type ?? ''}}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label d-flex align-items-center justify-content-between">رابط صورة 1 مايكروداتا</label>
                                <input type="text" class="form-control" name="microdata_image1" value="{{$content->microdata_image1 ?? ''}}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label d-flex align-items-center justify-content-between">رابط صورة 2 مايكروداتا</label>
                                <input type="text" class="form-control" name="microdata_image2" value="{{$content->microdata_image2 ?? ''}}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label d-flex align-items-center justify-content-between">رابط صورة 3 مايكروداتا</label>
                                <input type="text" class="form-control" name="microdata_image3" value="{{$content->microdata_image3 ?? ''}}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label d-flex align-items-center justify-content-between">وصف مايكروداتا</label>
                                <input type="text" class="form-control" name="microdata_description" value="{{$content->microdata_description ?? ''}}" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label d-flex align-items-center justify-content-between">قيمة التقييم </label>
                                <input type="text" class="form-control" name="microdata_ratingValue" value="{{$content->microdata_ratingValue ?? ''}}" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label d-flex align-items-center justify-content-between">أفضل قيمة التقييم </label>
                                <input type="text" class="form-control" name="microdata_bestRating" value="{{$content->microdata_bestRating ?? ''}}" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label d-flex align-items-center justify-content-between">العملة المستخدمة في العرض </label>
                                <input type="text" class="form-control" name="microdata_offer_priceCurrency" value="{{$content->microdata_offer_priceCurrency ?? ''}}" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label d-flex align-items-center justify-content-between">قيمة الخصم أو العرض</label>
                                <input type="text" class="form-control" name="microdata_offer_price" value="{{$content->microdata_offer_price ?? ''}}" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label d-flex align-items-center justify-content-between">تاريخ إنتهاء الخصم</label>
                                <input type="date" class="form-control" name="microdata_offer_price_valid_until" value="{{$content->microdata_offer_price_valid_until ?? ''}}" />
                            </div>


                        </div>
                    </div>
                    <div class="col-md-4">
                        <!--MicroData-->
                        <div class="microdata" style="float: left;word-break: break-all;" dir="ltr">
                            < script type="application/ld+json"> <br>
                            { <br>
                            "@context": "https://schema.org/", <br>
                            "@type": "نوع  مايكروداتا", <br>
                            "name": "اسم مايكروداتا", <br>
                            "image": [ <br>
                            "رابط صورة 1", <br>
                            "رابط صورة 2", <br>
                            "رابط صورة 3", <br>
                            ], <br>
                            "description": "وصف مايكروداتا", <br>
                            "sku": "0446310786", <br>
                            "mpn": "925872", <br>
                            "brand": { <br>
                            "@type": "Brand", <br>
                            "name": "اسم مايكروداتا" <br>
                            }, <br>
                            "review": { <br>
                            "@type": "Review", <br>
                            "reviewRating": { <br>
                            "@type": "Rating", <br>
                            "ratingValue": "قيمة التقييم", <br>
                            "bestRating": "أفضل قيمة التقييم" <br>
                            }, <br>
                            "author": { <br>
                            "@type": "Company", <br>
                            "name": "اسم مايكروداتا" <br>
                            } <br>
                            }, <br>
                            "aggregateRating": { <br>
                            "@type": "AggregateRating", <br>
                            "ratingValue": "4.9", <br>
                            "reviewCount": "154789" <br>
                            }, <br>
                            "offers": { <br>
                            "@type": "Offer", <br>
                            "url": "رابط كانونيكال", <br>
                            "priceCurrency": "العملة المستخدمة في العرض ", <br>
                            "price": "قيمة الخصم أو العرض", <br>
                            "priceValidUntil": "تاريخ إنتهاء الخصم", <br>
                            "itemCondition": "https://schema.org/UsedCondition", <br>
                            "availability": "https://schema.org/InStock" <br>
                            } <br>
                            } <br>
                            < /script>
                        </div>

                    </div>
                </div>





                    @include('admin_dashboard.inputs.edit_btn')
                </form>

        </div>
    </div>


@endsection


@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
            $("#validateForm").validate({
                rules: {
                    "discount_percentage": {
                        minlength: 0,
                        maxlength: 100,
                    },

                },
                messages: {
                    "discount_percentage": {
                        minlength:"يجب ان يكون أكبر من أو يساوي 0",
                        maxlength:"يجب أن لا يتعدي 100"
                    },
                }
            });
        });
    </script>
@endpush

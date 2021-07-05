@extends('sideMenuLayout')
@section('content')
    <div class="row m-0 page-title-wrapper d-md-flex align-items-md-center">
        <div class="col-md-6">
            <div class="title py-2">
                <h4 class="mb-0 font-weight-bold"><i class="fas fa-list mr-3"></i>বাটন</h4>
            </div>
        </div>
    </div>
    <div class="px-3">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5">
                    <div class="d-flex align-items-center justify-content-start flex-wrap">
                        <a href="javascript:;" title="প্রোফাইল"
                           class="btn btn-primary font-weight-bold text-white btn-profile btn-square mr-2">
                            <i class="fa fa-user"></i><span class="ml-2">প্রোফাইল </span>
                        </a>
                        <a href="javascript:;" title="হেল্প ডেস্ক"
                           class="btn btn-success font-weight-bold text-white btn-square mr-2">
                            <i class="fad fa-user-headset"></i><span class="ml-2">হেল্প ডেস্ক </span>
                        </a>
                        <a href="/nothi-next/logout" class="btn btn-danger font-weight-bold text-white btn-square mr-2">
                            <i class="fas fa-sign-out-alt"></i><span class="ml-2">লগ আউট </span>
                        </a>
                        <button class="btn btn-icon btn-light-success btn-square mr-2" type="button"><i
                                class="fad fa-search"></i></button>
                        <button class="btn btn-icon btn-light-danger btn-square mr-2" type="reset"><i
                                class="fad fa-recycle"></i></button>
                        <button class="btn btn-icon btn-secondary btn-square" type="button"><i
                                class="fad fa-chevron-left"></i></button>
                        <button class="btn btn-icon btn-secondary btn-square mr-2" type="button"><i
                                class="fad fa-chevron-right"></i></button>
                        <div class="action-group d-flex justify-content-end action-group-wrapper">
                            <a href="javascript:;"
                               class="mr-2 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary btn-archive list-btn-toggle"
                               data-dak-info="daak_container_inbox_1_54_Daptorik">
                                <i class="fa fa-archive"></i>
                            </a>
                            <button
                                class="mr-2 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                type="button">
                                <i class="fad fa-share"></i>
                            </button>
                            <a href="javascript:;"
                               class="mr-2 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle">
                                <i class="fad fa-books"></i>
                            </a>
                            <a href="javascript:;"
                               class="mr-2 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle">
                                <i class="fal fa-folder-open"></i>
                            </a>
                            <button
                                class="mr-2 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                type="button">
                                <i class="fas fa-repeat-alt"></i>
                            </button>
                            <button
                                class="mr-2 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary list-btn-toggle"
                                type="button">
                                <i class="fal fa-tags"></i>
                            </button>
                        </div>
                        <button class="btn btn-outline-primary btn-square mr-2" type="button">
                            <i class="fad fa-user-check"></i> প্রেরক বাছাই করুন <span class="text-danger font-size-h5"> * </span>
                        </button>
                        <button class="btn btn-info btn-sm btn-square text-right mr-2" type="button"><i
                                class="far fa-share-square"></i> নিজ ডেস্কে প্রেরণ
                        </button>
                        <button class="btn btn-info btn-sm btn-square text-right mr-2" type="button"><i
                                class="far fa-share-square"></i> নিজ ডেস্কে প্রেরণ
                        </button>
                        <button class="btn btn-sm btn-square btn-success mr-2" type="button"><i
                                class="fad fa-cloud"></i> খসড়া সংরক্ষণ
                        </button>
                        <button class="btn btn-primary btn-sm btn-square mr-2" type="button"><i
                                class="fa fa-paper-plane"></i> প্রেরণ
                        </button>
                        <button type="button" class="btn btn-icon btn-outline-success border-0 btn-xs mr-2"><i
                                class="fa fa-plus"></i></button>
                        <button type="button" data-designation-id="16345"
                                class="btn btn-icon btn-outline-danger btn-xs border-0 mr-2"><i
                                class="fal fa-trash-alt"></i></button>
                        <button type="button" class="btn btn-secondary btn-square mr-2"><i class="fa fa-times"></i>বন্ধ
                            করুন
                        </button>
                        <button type="button" class="btn btn-success btn-sm btn-square mr-2"><i
                                class="fad fa-folder-plus"></i> নতুন
                        </button>
                        <button type="button" class="btn btn-primary btn-square mr-2"><i class="fad fa-file-excel"></i>
                        </button>
                        <button type="button" class="btn btn-success btn-square mr-2"><i class="fad fa-file-pdf"></i>
                        </button>
                        <button class="btn btn-light-primary btn-square btn-icon mr-2"><i class="fa fa-bars"></i>
                        </button>
                        <button class="btn btn-icon btn-light-success btn-square btn-lg text-white mr-2"><i
                                class="fas fa-folder-plus"></i></button>
                        <button class="btn btn-icon btn-light-warning btn-square btn-lg text-white mr-2"><i
                                class="fad fa-users-class"></i></button>
                        <div class="btn-group align-items-center mr-2" role="group">
                            <button type="button" class="btn btn-sm btn-square btn-outline-light text-violate"><i
                                    class="fal fa-plus-square"></i><span class="px-2">নতুন নোট</span></button>
                            <button type="button" class="btn btn-sm btn-square btn-outline-light text-violate">
                                <i class="fad fa-copy"></i><span class="px-2">সকল নোট</span>
                            </button>
                            <button
                                class="btn btn-secondary btn-sm btn-square btn-outline-light btn-details-control-refresh">
                                <i class="fal fa-sync"></i> <span class="px-2">রিফ্রেশ</span></button>
                        </div>
                        <div class="btn-group text-center p-3 mr-3">
                            <label class="mt-1 checkbox checkbox-lg checkbox-light-danger flex-shrink-0 mr-4">
                                <input type="radio" value="1">
                                <span></span>
                            </label>
                            <button class="btn btn-sm btn-icon btn-secondary btn-nothi-view rounded-0">
                                <i class="fad fa-file-alt"></i>
                            </button>
                            <button class="btn btn-sm btn-icon btn-secondary btn-nothi-view-tab">
                                <i class="fal fa-external-link-square"></i>
                            </button>
                        </div>
                        <a href="/nothi-next/nothi" class="btn btn-sm btn-outline-warning btn-square mr-3">
                            <i class="fad fa-arrow-alt-left"></i> ফেরত যান
                        </a>
                        <button class="btn btn-info btn-sm btn-square mr-2" data-panel="main"><i
                                class="fad fa-book"></i>নথিসমূহ
                        </button>
                        <button
                            class="btn btn-outline-secondary justify-content-between d-flex btn-square card-toggle mr-2"
                            type="button">
                            <span class="text-nowrap mr-2 text-center"><i class="fad fa-search"></i> নোট খুঁজুন</span>
                        </button>
                        <button class="btn btn-outline-secondary justify-content-between d-flex btn-square mr-2"
                                type="button">
                            <span class="text-nowrap mr-2"><i class="far fa-file-alt"></i> নতুন নোট </span>
                        </button>
                        <div class="btn-group mr-2">
                            <a tabindex="0" href="javascript:;" role="button"
                               class="write_onucched btn btn-sm btn-square btn-success"><i class="fa fa-plus"></i>
                                <span>অনুচ্ছেদ লিখুন</span></a>
                            <a tabindex="0" href="javascript:;" role="button"
                               class="btn btn-primary btn-sm btn-square btn-forward" id="onucched_forward"><i
                                    class="fa fa-paper-plane"></i>প্রেরণ করুন</a>
                        </div>
                        <div class="btn-group mr-2">
                            <div class="dropdown">
                                <button
                                    class="btn btn-square btn-sm btn-success d-flex align-items-center dropdown-toggle"
                                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fad fa-cloud"></i> <span class="ml-1">সংরক্ষণ</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="javascript:;"> <span><i
                                                class="fad fa-cloud mr-2"></i>সংরক্ষণ</span></a>
                                    <a class="dropdown-item" href="javascript:;"> <span><i
                                                class="fad fa-cloud mr-2"></i>সংরক্ষণ ও খসড়া</span></a>
                                    <a class="dropdown-item" data-btn-type="new" href="javascript:;"> <span><i
                                                class="fad fa-cloud mr-2"></i>সংরক্ষণ ও নতুন অনুচ্ছেদ</span></a>
                                    <a class="dropdown-item" data-btn-type="send" href="javascript:;"> <span><i
                                                class="fad fa-cloud mr-2"></i>সংরক্ষণ ও প্রেরণ</span></a>
                                </div>
                            </div>
                            <button class="btn btn-square btn-sm btn-danger d-flex align-items-center mr-2">
                                <i class="fs1 a2i_gn_close2 "></i> <span class="ml-1">বাতিল করুন</span>
                            </button>
                            <button type="button" class="btn btn-danger remove-attachment btn-square">
                                <i class="fal fa-trash-alt pr-0"></i>
                            </button>
                        </div>
                        <div class="d-md-flex mr-2">
                            <button
                                class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                type="button">
                                <i class="fa fa-users pr-1"></i>
                            </button>
                            <button
                                class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary">
                                <i class="fas fa-edit"></i></button>
                            <button
                                class="mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary">
                                <i class="fas fa-eye"></i></button>
                        </div>
                        <div class="btn-group mr-2">
                            <button class="btn btn-warning btn-sm btn-square"><i class="fa fa-save"></i>সংরক্ষণ</button>
                            <button data-content="" class="btn btn-info btn-sm btn-square" data-panel="main"><i
                                    class="fad fa-book"></i> নথিসমূহ
                            </button>
                        </div>
                        <button class="border btn-sm rounded-0 btn-info mr-2">
                            <i class="fas fa-plus"></i> নতুন সংযুক্তি
                        </button>
                        <div class="d-md-flex justify-content-end mr-2">
                            <div class="dropdown">
                                <button data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-key="2"
                                        class="btn-share-user-list font-size-lg rounded-0 mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"
                                        type="button">
                                    <i data-toggle="popover" data-content="শেয়ার তালিকা" class="fad fa-share-alt"></i>
                                </button>
                                <div class="dropdown-menu share-user-list" aria-labelledby="dropdownMenuLink" style="">
                                    <div class="d-flex align-items-center p-2"><a style="cursor: default;"
                                                                                  class="dropdown-item"
                                                                                  href="javascript:;"><strong>বোরহান
                                                উদ্দিন</strong><span class="ml-2">এডমিন স্পেশালিস্ট,এডমিন,এসপায়ার টু ইনোভেট (এটু্আই) প্রোগ্রাম</span></a>
                                        <a href="javascript:" id="removeShareUser" class="" style="cursor: pointer;"><i
                                                class="fas fa-times-circle text-danger"></i></a></div>
                                    <div class="d-flex align-items-center p-2"><a style="cursor: default;"
                                                                                  class="dropdown-item"
                                                                                  href="javascript:;"><strong>জাফরিন
                                                আহমেদ</strong><span class="ml-2">সফটওয়্যার ইঞ্জিনিয়ার,ই-সার্ভিস,এসপায়ার টু ইনোভেট (এটু্আই) প্রোগ্রাম</span></a>
                                        <a href="javascript:" id="removeShareUser" class="" style="cursor: pointer;"><i
                                                class="fas fa-times-circle text-danger"></i></a></div>
                                </div>
                            </div>
                            <a class="text-dark text-hover-primary mb-1 font-size-lg mr-1 btn btn-icon btn-square btn-sm btn-light btn-hover-icon-danger btn-icon-primary"><i
                                    class="fas fa-file-import"></i></a>
                        </div>
                        <button class="btn btn-success btn-sm btn-bold btn-square mr-2" type="button"><i
                                class="far fa-plus mr-1"></i>নতুন ধরন
                        </button>
                        <button class="btn btn-success btn-square mr-2" type="button"><i class="fad fa-cloud pr-0"></i>
                        </button>
                        <button class="btn btn-sm btn-success btn-square mr-2" type="button"><i class="fa fa-plus"></i>নতুন
                            পত্রজারি গ্রুপ
                        </button>
                        <a class="btn btn-lg btn-icon btn-success btn-square mr-2" data-toggle="collapse"
                           aria-expanded="false"><i data-toggle="popover" class="fas fa-users"></i></a>
                        <a href="#" title="প্রোফাইল সংশোধন"
                           class="btn btn-primary font-weight-bold text-white btn-square btn-sm">
                            <i class="fa fa-pencil"></i><span class="ml-2">প্রোফাইল সংশোধন</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

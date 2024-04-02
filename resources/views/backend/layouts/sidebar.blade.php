<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu">
        <!--<div class="pcoded-navigatio-lavel">Navigation</div>-->
        <ul class="pcoded-item pcoded-left-item">
            <li class="{{set_active_route('dashboard','active')}}">
                <a href="{{route('dashboard')}}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>
  
        </ul>
        <!--<div class="pcoded-navigatio-lavel">General</div>-->
        <!--<ul class="pcoded-item pcoded-left-item">-->
        <!--    <li class="{{set_active_route('chat','active')}}">-->
        <!--        <a href="{{route('chat')}}">-->
        <!--            <span class="pcoded-micon"><i class="feather icon-message-square"></i></span>-->
        <!--            <span class="pcoded-mtext">Chat</span>-->
        <!--        </a>-->
        <!--    </li>-->
  
        <!--    <li class="{{set_active_route('reviews','active')}}">-->
        <!--      <a href="{{route('reviews.index')}}">-->
        <!--          <span class="pcoded-micon"><i class="fa fa-commenting"></i></span>-->
        <!--          <span class="pcoded-mtext">Reviews </span>-->
        <!--      </a>-->
        <!--  </li>-->
  
        <!--</ul>-->
        <!--<div class="pcoded-navigatio-lavel">Management</div>-->
        <ul class="pcoded-item pcoded-left-item">
  
          <!--<li class="{{set_active_route('support-ticket/','active')}}">-->
          <!--    <a href="{{route('tickets.index')}}">-->
          <!--        <span class="pcoded-micon"><i class="fa fa-ticket"></i></span>-->
          <!--        <span class="pcoded-mtext">Support Tickets</span>-->
          <!--        <span class="pcoded-badge label label-warning">{{getTicketsCountByStatus('open')}}</span>-->
  
          <!--    </a>-->
          <!--</li>-->
          <!--<li class="{{set_active_route('withdraws/','active')}}">-->
          <!--    <a href="{{route('withdraw.index')}}">-->
          <!--        <span class="pcoded-micon"><i class="fa fa-credit-card"></i></span>-->
          <!--        <span class="pcoded-mtext">Withdraws</span>-->
          <!--        <span class="pcoded-badge label label-warning">{{getAuthUserWithdraw('pending')}}</span>-->
  
          <!--    </a>-->
          <!--</li>-->
          <!--<li class="{{set_active_route('deposits','active')}}">-->
          <!--    <a href="{{route('deposits.index')}}">-->
          <!--        <span class="pcoded-micon"><i class="fa fa-bank"></i></span>-->
          <!--        <span class="pcoded-mtext">Deposits</span>-->
          <!--        <span class="pcoded-badge label label-warning">{{getDepositCountByStatus('pending')}}</span>-->
  
          <!--    </a>-->
          <!--</li>-->
         
          @can('manage users')
              
          <li class="{{set_active_route('users','active')}}">
              <a href="{{route('users.index')}}">
                  <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                  <span class="pcoded-mtext">Users</span>
              </a>
          </li>
          @endcan
  
          <li class="pcoded-hasmenu {{ set_active_route('booking/', 'pcoded-trigger') }}">
              <a href="javascript:void(0)">
                  <span class="pcoded-micon"><i class="feather icon-edit-1"></i></span>
                  <span class="pcoded-mtext">Bookings</span>
              </a>
              <ul class="pcoded-submenu">
                
                  <li class="{{set_active_route('/booking-list','active')}}">
                      <a href="{{route('/booking-list')}}">
                          <span class="pcoded-micon"><i class="feather icon-edit-1"></i></span>
                          <span class="pcoded-mtext">All</span>
                      </a>
                  </li>
  
                  <li class="{{set_active_route('flight','active')}}">
                      <a href="{{route('flight.index')}}">
                          <span class="pcoded-micon"><i class="feather icon-edit-1"></i></span>
                          <span class="pcoded-mtext">Flight</span>
                      </a>
                  </li>
                  <li class="{{set_active_route('tour-bookings','active')}}">
                      <a href="{{route('tour-bookings.index')}}">
                          <span class="pcoded-micon"><i class="feather icon-edit-1"></i></span>
                          <span class="pcoded-mtext">Toures</span>
                      </a>
                  </li>
                  @can('manage booking inquiries')
                      
                  <!--<li class="{{set_active_route('booking-inquiry','active')}}">-->
                  <!--    <a href="{{route('booking-inquiry')}}">-->
                  <!--        <span class="pcoded-micon"><i class="feather icon-edit-1"></i></span>-->
                  <!--        <span class="pcoded-mtext">Inquiries</span>-->
                  <!--    </a>-->
                  <!--</li>-->
                  @endcan
  
  
              </ul>
          </li>
  
          <!--<li class="{{set_active_route('properties','active')}}">-->
          <!--    <a href="{{route('properties.index')}}">-->
          <!--        <span class="pcoded-micon"><i class="fa fa-bed"></i></span>-->
          <!--        <span class="pcoded-mtext">Properties</span>-->
          <!--    </a>-->
          <!--</li>-->
          
          @can('manage settings')
          <li class="pcoded-hasmenu {{ set_active_route('/settings', 'pcoded-trigger') }}">
              <a href="javascript:void(0)">
                  <span class="pcoded-micon"><i class="fa fa-cog"></i></span>
                  <span class="pcoded-mtext">Settings & CMS</span>
              </a>
              <ul class="pcoded-submenu">
  
                  <li class="{{set_active_route('blogs','active')}}">
                      <a href="{{route('blogs.index')}}">
                          <span class="pcoded-micon"><i class="fa fa-shopping-bag"></i></span>
                          <span class="pcoded-mtext">Blogs</span>
                          
                      </a>
                  </li>

                  <li class="{{set_active_route('currency-rates','active')}}">
                    <a href="{{route('currency-rates.index')}}">
                        <span class="pcoded-micon"><i class="fa fa-shopping-bag"></i></span>
                        <span class="pcoded-mtext">Currency Rates</span>
                        
                    </a>
                </li>
                  
                  <li class="{{set_active_route('/settings/contact.index','active')}}">
                      <a href="{{route('/settings/contact.index')}}">
                          <span class="pcoded-micon"><i class="fa fa-shopping-bag"></i></span>
                          <span class="pcoded-mtext">Contact Details</span>
                          
                      </a>
                  </li>
                  <li class="{{set_active_route('modules','active')}}">
                      <a href="{{route('modules.index')}}">
                          <span class="pcoded-micon"><i class="fa fa-shopping-bag"></i></span>
                          <span class="pcoded-mtext">Modules</span>
                          
                      </a>
                  </li>
                  <li class="{{set_active_route('modules-apis','active')}}">
                      <a href="{{route('modules-apis.index')}}">
                          <span class="pcoded-micon"><i class="fa fa-shopping-bag"></i></span>
                          <span class="pcoded-mtext">Module Api's</span>
                          
                      </a>
                  </li>
  
                  <li class="{{set_active_route('pages','active')}}">
                      <a href="{{route('pages.index')}}">
                          <span class="pcoded-micon"><i class="fa fa-shopping-bag"></i></span>
                          <span class="pcoded-mtext">Pages</span>
                          
                      </a>
                  </li>
  
                  <li class="{{set_active_route('/settings/section.index','active')}}">
                      <a href="{{route('/settings/section.index')}}">
                          <span class="pcoded-micon"><i class="fa fa-shopping-bag"></i></span>
                          <span class="pcoded-mtext">Sections</span>
                          
                      </a>
                  </li>
  
                  <li class="{{set_active_route('siteIdentity.index','active')}}">
                      <a href="{{route('siteIdentity.index')}}">
                          <span class="pcoded-micon"><i class="fa fa-shopping-bag"></i></span>
                          <span class="pcoded-mtext">Site Identity</span>
                          
                      </a>
                  </li>
  
                
                  <li class="{{set_active_route('testimonials.index','active')}}">
                      <a href="{{route('testimonials.index')}}">
                          <span class="pcoded-micon"><i class="fa fa-shopping-bag"></i></span>
                          <span class="pcoded-mtext">Testimonials</span>
                          
                      </a>
                  </li>
  
                  {{-- <li class="{{set_active_route('/settings/terms.index','active')}}">
                      <a href="{{route('/settings/terms.index')}}">
                          <span class="pcoded-micon"><i class="fa fa-shopping-bag"></i></span>
                          <span class="pcoded-mtext">Terms & Privacy</span>
                          
                      </a>
                  </li> --}}
                 
          
              </ul>
          </li>
          @endcan
          @can('manage configurations')
          <li class="pcoded-hasmenu {{ set_active_route('configurations/', 'pcoded-trigger') }}">
              <a href="javascript:void(0)">
                  <span class="pcoded-micon"><i class="fa fa-cogs"></i></span>
                  <span class="pcoded-mtext">Configurations</span>
              </a>
              <ul class="pcoded-submenu">
                
                  <li class="{{set_active_route('email-settings','active')}}">
                      <a href="{{route('email-settings.index')}}">
                          <span class="pcoded-micon"><i class="fa fa-shopping-bag"></i></span>
                          <span class="pcoded-mtext">Email Settings</span>
                          
                      </a>
                  </li>
  
                
          
              </ul>
          </li>
          @endcan
          @can('manage promo')
          <li class="pcoded-hasmenu {{ set_active_route('promosAndDiscounts/', 'pcoded-trigger') }}">
              <a href="javascript:void(0)">
                  <span class="pcoded-micon"><i class="fa fa-shopping-bag"></i></span>
                  <span class="pcoded-mtext">Promos & Discounts</span>
              </a>
              <ul class="pcoded-submenu">
                  @can('manage promo')
  
                  <!--<li class="{{set_active_route('promo-codes','active')}}">-->
                  <!--    <a href="{{route('promo-codes.index')}}">-->
                  <!--        <span class="pcoded-micon"><i class="fa fa-shopping-bag"></i></span>-->
                  <!--        <span class="pcoded-mtext">Promo Codes</span>-->
                          
                  <!--    </a>-->
                  <!--</li>-->
          
                  @endcan
  
                  @can('manage commissions')
              
                  <li class="{{set_active_route('commissions','active')}}">
                      <a href="{{route('commissions.index')}}">
                          <span class="pcoded-micon"><i class="fa fa-money"></i></span>
                          <span class="pcoded-mtext">Commissions</span>
                      </a>
                  </li>
                 
                  <li class="{{set_active_route('custom-fees','active')}}">
                      <a href="{{route('custom-fees.index')}}">
                          <span class="pcoded-micon"><i class="fa fa-money"></i></span>
                          <span class="pcoded-mtext">Custom Fees</span>
                      </a>
                  </li>
                  @endcan
             
              </ul>
          </li>
          @endcan
          @can('manage plans')
  
          <!--<li class="pcoded-hasmenu {{ set_active_route('MembershipAndPlans/', 'pcoded-trigger') }}">-->
          <!--    <a href="javascript:void(0)">-->
          <!--        <span class="pcoded-micon"><i class="fa fa-asl-interpreting"></i></span>-->
          <!--        <span class="pcoded-mtext">Membership & plans</span>-->
          <!--    </a>-->
          <!--    <ul class="pcoded-submenu">-->
             
          <!--        <li class="{{set_active_route('plans','active')}}">-->
          <!--            <a href="{{route('plans.index')}}" >-->
          <!--                <span class="pcoded-mtext">Plans</span>-->
          <!--            </a>-->
          <!--        </li>-->
  
    
          <!--        <li class="{{set_active_route('memberships','active')}}">-->
          <!--            <a href="{{route('memberships.index')}}" >-->
          <!--                <span class="pcoded-mtext">Memberships</span>-->
          <!--            </a>-->
          <!--        </li>-->
             
          <!--    </ul>-->
          <!--</li>-->
          @endcan
  
          @can('manage adds')
             
          <li class="pcoded-hasmenu {{ set_active_route('advertisements/', 'pcoded-trigger') }}">
              <a href="javascript:void(0)">
                  <span class="pcoded-micon"><i class="fa fa-bullhorn"></i></span>
                  <span class="pcoded-mtext">Advertisements</span>
              </a>
              <ul class="pcoded-submenu">
             
                  <li class="{{set_active_route('advertisements','active')}}">
                      <a href="{{route('advertisements.index')}}">
                          <span class="pcoded-micon"><i class="fa fa-bullhorn"></i></span>
                          <span class="pcoded-mtext"> Custom Ads</span>
                      </a>
                  </li>
    
                  <li class="{{set_active_route('google-ads','active')}}">
                      <a href="{{route('google-ads.index')}}">
                          <span class="pcoded-micon"><i class="fa fa-bullhorn"></i></span>
                          <span class="pcoded-mtext">Google Ads</span>
                      </a>
                  </li>
             
              </ul>
          </li>
  
          @endcan
          @can('manage packages')
              
          <li class="pcoded-hasmenu {{ set_active_route('packages/', 'pcoded-trigger') }}">
              <a href="javascript:void(0)">
                  <span class="pcoded-micon"><i class="fa fa-inbox"></i></span>
                  <span class="pcoded-mtext">Packages</span>
              </a>
              <ul class="pcoded-submenu">
                  
                  <li class="{{set_active_route('categories.index','active')}}">
                      <a href="{{route('categories.index')}}" >
                          <span class="pcoded-mtext">Categories</span>
                      </a>
                  </li>
  
                  <li class="{{set_active_route('packages.index','active')}}">
                      <a href="{{route('packages.index')}}" >
                          <span class="pcoded-mtext">All Packages</span>
                      </a>
                  </li>
  
              </ul>
          </li>
          @endcan
  
          @can('manageRolesPermissions')
              
          <li class="pcoded-hasmenu {{ set_active_route('/RolesandPermissions', 'pcoded-trigger') }}">
              <a href="javascript:void(0)">
                  <span class="pcoded-micon"><i class="feather icon-shield"></i></span>
                  <span class="pcoded-mtext">Roles & Permissions</span>
              </a>
              <ul class="pcoded-submenu">
                  @can('manage roles')
                      
                  <li class="{{set_active_route('/roles','active')}}">
                      <a href="{{route('/roles.index')}}" >
                          <span class="pcoded-mtext">Roles</span>
                      </a>
                  </li>
                  @endcan
                  @can('manage permissions')
                      
                  <li class="{{set_active_route('/permissions','active')}}">
                      <a href="{{route('/permissions.index')}}" >
                          <span class="pcoded-mtext">Permissions</span>
                      </a>
                  </li>
                  @endcan
  
              </ul>
          </li>
          @endcan
          @can('manage payments')
              
          <li class="pcoded-hasmenu {{ set_active_route('payments/', 'pcoded-trigger') }}">
              <a href="javascript:void(0)">
                  <span class="pcoded-micon"><i class="fa fa-dollar"></i></span>
                  <span class="pcoded-mtext">Payments</span>
              </a>
              <ul class="pcoded-submenu">
  
                  <li class="{{set_active_route('payment-methods','active')}}">
                      <a href="{{route('payment-methods.index')}}" >
                          <span class="pcoded-mtext">Payment Methods</span>
                      </a>
                  </li>
                  
                  <!--<li class="{{set_active_route('transactions','active')}}">-->
                  <!--    <a href="{{route('transactions.index')}}" >-->
                  <!--        <span class="pcoded-mtext">Transactions</span>-->
                  <!--    </a>-->
                  <!--</li>-->
                  <li class="{{set_active_route('banks','active')}}">
                      <a href="{{route('banks.index')}}" >
                          <span class="pcoded-mtext">Banks</span>
                      </a>
                  </li>
              </ul>
          </li>
          @endcan
  
        </ul>
  
    </div>
  </nav>
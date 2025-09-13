
<x-adminheader/>
<div class="content-section">
            

<div class="breadcrumb">
  <h1>Dashboard</h1>
</div>

<div class="separator-breadcrumb border-top"></div>

  <div id="section_Dashboard">
    <div class="row">
      <div class="col-lg-6 col-md-12 mb-4">
        <div class="card p-4 d-flex flex-row align-items-center justify-content-between">
          <div>
            <p class="text-primary fw-semibold mb-1 font_17">
            Good Morning, William Castillo!
            </p>
            <p class="p-0 m-0 text-gray-600 font_14">
              Here’s what happening with your store today!
            </p>
            <div class="dashboard_today_purchases">
              <h4 class="fw-semibold fs-4 mb-1">
                 $ 1,040.00
              </h4>
              <p class="p-0 m-0 text-gray-600 font_14">
                Today’s total Purchases
              </p>
            </div>
            <div>
              <h4 class="fw-semibold fs-4 mb-1">
                 $ 341.00
              </h4>
              <p class="p-0 m-0 text-gray-600 font_14">
                Today’s total Sales
              </p>
            </div>
          </div>
          <img class="pe-lg-3" width="194" height="170" src="https://posly.getstocky.com/images/overview.png" alt="">
        </div>
      </div>
      <div class="col-lg-6 col-md-12">
        <div class="row">
          <div class="col-md-6 col-sm-6">
            <a href="{{ URL::to('/sales') }}" class="card_dashboard">
              <div class="card card-icon-big mb-4">
                <p class="text-gray-600">
                  Sales
                </p>
                <h4 class="fw-semibold fs-4 mb-1">
                 $ 341.00
                </h4>
               
              </div>
            </a>
          </div>
    
          <div class="col-md-6 col-sm-6">
            <a href="{{ URL::to('/purchases') }}" class="card_dashboard">
              <div class="card card-icon-big mb-4">
                <p class="text-gray-600">
                  Purchases
                </p>
                <h4 class="fw-semibold fs-4 mb-1">
                $ 1,040.00
                </h4>
               
              </div>
            </a>
          </div>
    
          <div class="col-md-6 col-sm-6">
            <a href="{{ URL::to('/purchases') }}" class="card_dashboard">
              <div class="card card-icon-big mb-4">
                <p class="text-gray-600">
                  Sales Return
                </p>
                <h4 class="fw-semibold fs-4 mb-1">
                 $ 0.00
                </h4>
              
              </div>
            </a>
          </div>
    
          <div class="col-md-6 col-sm-6">
            <a href="/purchase-return/returns_purchase" class="card_dashboard">
              <div class="card card-icon-big mb-4">
                <p class="text-gray-600">
                  Purchases Return
                </p>
                <h4 class="fw-semibold fs-4 mb-1">
                 $ 0.00
                </h4>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="row align-items-center">
      <div class="col-lg-8 col-md-12">
        <div class="card mb-4">
          <div class="card-body">
            <div class="card-title">
              <h6 class="fw-semibold font_17">
                This Week Sales &amp; Purchases
              </h6>
            </div>
            <div id="echart_sales_purchase" style="-webkit-tap-highlight-color: transparent; user-select: none; position: relative;" _echarts_instance_="ec_1745394533056"><div style="position: relative; overflow: hidden; width: 694px; height: 300px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas data-zr-dom-id="zr_0" width="694" height="300" style="position: absolute; left: 0px; top: 0px; width: 694px; height: 300px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div><div></div></div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-12">
        <div class="card mb-4">
          <div class="card-body">
            <div class="card-title">
              <h6 class="fw-semibold font_17">
                Top Selling Products (2025)
              </h6>
            </div>
            <div id="echart_Top_products" style="-webkit-tap-highlight-color: transparent; user-select: none; position: relative;" _echarts_instance_="ec_1745394533058">
              <div style="position: relative; overflow: hidden; width: 319px; height: 300px; padding: 0px; margin: 0px; border-width: 0px;">
                <canvas data-zr-dom-id="zr_0" width="319" height="300" style="position: absolute; left: 0px; top: 0px; width: 319px; height: 300px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas>
              </div>
              <div></div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4>Recent Sales</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="dashboard_table" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer" "="">
                <thead>
                  <tr>
                    <th>Ref</th>
                    <th>Customer</th>
                    <th>Grand Total</th>
                    <th>Paid</th>
                    <th>Due</th>
                  </tr>
                </thead>
                <tbody class="table_body_recent_sales">
                                      <tr>
                      <td>SO-20230616-035252</td>
                      <td>Phyliss J. Polite</td>
                      <td>$ 203.00</td>
                      <td>$ 203.00</td>
                      <td>$ 0.00</td>
                    </tr>
                                      <tr>
                      <td>SO-20230616-035216</td>
                      <td>Beverly B. Huber</td>
                      <td>$ 341.00</td>
                      <td>$ 0.00</td>
                      <td>$ 341.00</td>
                    </tr>
                                      <tr>
                      <td>SO-20230616-034825</td>
                      <td>Beverly B. Huber</td>
                      <td>$ 202.00</td>
                      <td>$ 100.00</td>
                      <td>$ 102.00</td>
                    </tr>
                                      <tr>
                      <td>SO-20230616-034752</td>
                      <td>walk-in-customer</td>
                      <td>$ 285.00</td>
                      <td>$ 285.00</td>
                      <td>$ 0.00</td>
                    </tr>
                                      <tr>
                      <td>SO-20230616-034724</td>
                      <td>Fred C. Rasmussen</td>
                      <td>$ 280.00</td>
                      <td>$ 280.00</td>
                      <td>$ 0.00</td>
                    </tr>
                                  </tbody>

              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-12">
        <div class="card mb-4">
          <div class="card-body">
            <div class="card-title">Top Clients (Apr, 2025)</div>
            <div id="echart_Top_Clients" style="-webkit-tap-highlight-color: transparent; user-select: none; position: relative;" _echarts_instance_="ec_1745394533057"><div style="position: relative; overflow: hidden; width: 319px; height: 300px; padding: 0px; margin: 0px; border-width: 0px;"><canvas data-zr-dom-id="zr_0" width="319" height="300" style="position: absolute; left: 0px; top: 0px; width: 319px; height: 300px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div><div></div></div>
          </div>
        </div>
      </div>

    </div>

  </div>
</div>
<x-adminfooter/>
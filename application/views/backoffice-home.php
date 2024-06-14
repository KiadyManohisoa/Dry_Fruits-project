<!-- recherche de clients -->
<div class="content">
    <h2>Clients Search</h2>
    <form class="col-lg-6 col-md-6">
        <div class="form-group">
            <input class="form-control" type="text" class="form-control form-control-custom" placeholder="Enter the client full name">
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-custom btn-lg">Submit</button>
        </div>
    </form>
    <hr>
    <div id="table">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Purchases</th>
                    <th>Date last activities</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Ninja Kassadias</td>
                    <td>ninja@impekable.com</td>
                    <td>933923223</td>
                    <td>xxx</td>
                    <td>xx-xx-xxxx</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<!-- recherche de clients -->

<!-- bilan de production -->
<div class="content">
    <h2>Production situation report</h2>
    <form class="col-lg-6 col-md-6">
        <div class="form-group col-lg-6 col-mg-6 col-sm-6">
            <label for="date">Date</label>
            <input class="form-control" id="date" type="date">
        </div>
        <div class="form-group col-lg-6 col-mg-6 col-sm-6">
            <label for="categorie">Products Categories</label>
            <select class="form-control" name="" id="categorie">
                <option value="">Dried</option>
            </select>
        </div>
        <div class="form-group text-right">
            <button type="submit" class="btn btn-custom btn-lg">Submit</button>
        </div>
    </form>
    <hr>
    <div id="table">
        <h3>xx-xx-xxxx</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Wording</th>
                    <th>Stock</th>
                    <th>Out</th>
                    <th>Sales</th>
                    <th>Charges</th>
                    <th>Sales Amount</th>
                    <th>Results</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Dried Bananas</td>
                    <td>xxx kg</td>
                    <td>xxx kg</td>
                    <td>xxx kg</td>
                    <td>x xxx Ar</td>
                    <td>x xxx xxx Ar</td>
                    <td>x xxx xxx Ar</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
<!-- bilan de production -->

<!-- bilan general -->
<div class="content">
    <h2>General Report</h2>
    <form class="col-lg-6 col-md-6">
        <div class="form-group">
            <input class="form-control" type="date" class="form-control form-control-custom">
        </div>
        <div class="form-group text-right">
            <button class="btn btn-custom btn-lg" onclick="submitForm()">Submit</button>
        </div>
    </form>
    <hr>
    <div class="results">
        <p>Monthly sales: <span id="sales">xx xxxx Ar</span></p>
        <p>Monthly charges: <span id="charges">xx xxxx Ar</span></p>
        <p>Monthly results: <span id="results">xx xxxx Ar</span></p>
    </div>
    <div class="chart-container">
        <center>
            <canvas id="global-chart" width="400" height="200"></canvas>
            <h3>Graph of evolution of Sales - Expenses - Results</h3>
        </center>
    </div>

    <div class="chart-container">
        <h3>Sales figures</h3>
        <center>
            <canvas id="sales-chart" width="400" height="200"></canvas>
            <h3>Graph of evolution of Sales figures</h3>
        </center>
    </div>
</div>
<!-- bilan general -->
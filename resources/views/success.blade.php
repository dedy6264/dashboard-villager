@extends('app')
@section('mainContent')
<main>
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-xl-3"></div>
            <div class="col-xl-6 text-center">
                <h1 class="mt-4 ">Toko Merchant ABC</h1>
                <p>Telp. 08967897656563</p>
                <p>Jl. Pemuda Utara No.23A Kel. Klaten Utara Kec. Klaten Utara Kab. Klaten</p>
                <p>Jateng</p>
                <hr>
                <table class="table">
                    <tr>
                        <th>item</th>
                        <th>qty</th>
                        <th>harga</th>
                        <th>sub total</th>
                    </tr>
                    <tr>
                        <td>Sabun</td>
                        <td>2</td>
                        <td>5.000</td>
                        <td>10.000</td>
                    </tr>
                    <tr>
                        <td>Sabun</td>
                        <td>2</td>
                        <td>5.000</td>
                        <td>10.000</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-start">Total</td>
                        <td>20.000</td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-start">Pajak</td>
                        <td>10%</td>
                        <td>2.000</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-start">Grant Total</td>
                        <td>22.000</td>
                    </tr>
                </table>

                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Transaksi yang telah dibeli tidak dapat dikembalikan atau ditukar</li>
                </ol>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Print</button>
            </div>
            <div class="col-xl-3"></div>
        </div>
    </div>
</main>
@endsection
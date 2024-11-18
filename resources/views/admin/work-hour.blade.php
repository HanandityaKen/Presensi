@extends('layout.main') 

@section('content')

<div class="container mx-auto p-4">
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <!-- <h2 class="text-2xl text-blue-500 font-semibold mb-6">Work Hour</h2> -->
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl text-blue-500 font-semibold">Jam Kerja</h2>
            <a href="#" class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Tambah data</a>
        </div>
        <div class="overflow-x-auto">
            
        <table id="search-table">
            <thead>
                <tr>
                    <th>
                        <span class="flex items-center">
                            Company Name
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Ticker
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Stock Price
                        </span>
                    </th>
                    <th>
                        <span class="flex items-center">
                            Market Capitalization
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Apple Inc.</td>
                    <td>AAPL</td>
                    <td>$192.58</td>
                    <td>$3.04T</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Microsoft Corporation</td>
                    <td>MSFT</td>
                    <td>$340.54</td>
                    <td>$2.56T</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Alphabet Inc.</td>
                    <td>GOOGL</td>
                    <td>$134.12</td>
                    <td>$1.72T</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Amazon.com Inc.</td>
                    <td>AMZN</td>
                    <td>$138.01</td>
                    <td>$1.42T</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">NVIDIA Corporation</td>
                    <td>NVDA</td>
                    <td>$466.19</td>
                    <td>$1.16T</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Tesla Inc.</td>
                    <td>TSLA</td>
                    <td>$255.98</td>
                    <td>$811.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Meta Platforms Inc.</td>
                    <td>META</td>
                    <td>$311.71</td>
                    <td>$816.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Berkshire Hathaway Inc.</td>
                    <td>BRK.B</td>
                    <td>$354.08</td>
                    <td>$783.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">TSMC</td>
                    <td>TSM</td>
                    <td>$103.51</td>
                    <td>$538.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">UnitedHealth Group Incorporated</td>
                    <td>UNH</td>
                    <td>$501.96</td>
                    <td>$466.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Johnson & Johnson</td>
                    <td>JNJ</td>
                    <td>$172.85</td>
                    <td>$452.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">JPMorgan Chase & Co.</td>
                    <td>JPM</td>
                    <td>$150.23</td>
                    <td>$431.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Visa Inc.</td>
                    <td>V</td>
                    <td>$246.39</td>
                    <td>$519.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Eli Lilly and Company</td>
                    <td>LLY</td>
                    <td>$582.97</td>
                    <td>$552.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Walmart Inc.</td>
                    <td>WMT</td>
                    <td>$159.67</td>
                    <td>$429.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Samsung Electronics Co., Ltd.</td>
                    <td>005930.KS</td>
                    <td>$70.22</td>
                    <td>$429.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Procter & Gamble Co.</td>
                    <td>PG</td>
                    <td>$156.47</td>
                    <td>$366.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Nestlé S.A.</td>
                    <td>NESN.SW</td>
                    <td>$120.51</td>
                    <td>$338.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Roche Holding AG</td>
                    <td>ROG.SW</td>
                    <td>$296.00</td>
                    <td>$317.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Chevron Corporation</td>
                    <td>CVX</td>
                    <td>$160.92</td>
                    <td>$310.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">LVMH Moët Hennessy Louis Vuitton</td>
                    <td>MC.PA</td>
                    <td>$956.60</td>
                    <td>$478.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Pfizer Inc.</td>
                    <td>PFE</td>
                    <td>$35.95</td>
                    <td>$200.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Novo Nordisk A/S</td>
                    <td>NVO</td>
                    <td>$189.15</td>
                    <td>$443.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">PepsiCo, Inc.</td>
                    <td>PEP</td>
                    <td>$182.56</td>
                    <td>$311.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">ASML Holding N.V.</td>
                    <td>ASML</td>
                    <td>$665.72</td>
                    <td>$273.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">The Coca-Cola Company</td>
                    <td>KO</td>
                    <td>$61.37</td>
                    <td>$265.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Oracle Corporation</td>
                    <td>ORCL</td>
                    <td>$118.36</td>
                    <td>$319.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Merck & Co., Inc.</td>
                    <td>MRK</td>
                    <td>$109.12</td>
                    <td>$276.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Broadcom Inc.</td>
                    <td>AVGO</td>
                    <td>$861.80</td>
                    <td>$356.00B</td>
                </tr>
                <tr>
                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">Mastercard Incorporated</td>
                    <td>MA</td>
                    <td>$421.44</td>
                    <td>$396.00B</td>
                </tr>
            </tbody>
        </table>


        </div>
        
        <!-- Pagination -->
        <!-- <div class="mt-4 flex justify-between items-center">
            <div class="text-gray-600">
                Menampilkan 1 sampai 10 dari 50 data
            </div>
            <div class="flex space-x-2">
                <button class="px-3 py-1 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">Sebelumnya</button>
                <button class="px-3 py-1 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">1</button>
                <button class="px-3 py-1 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">2</button>
                <button class="px-3 py-1 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">3</button>
                <button class="px-3 py-1 bg-gray-200 text-gray-600 rounded hover:bg-gray-300">Selanjutnya</button>
            </div>
        </div> -->
    </div>
</div>

@endsection

@push('scripts')
<script>
    if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
     const dataTable = new simpleDatatables.DataTable("#search-table", {
          searchable: true,
          sortable: false
      });
    } 
</script>
@endpush


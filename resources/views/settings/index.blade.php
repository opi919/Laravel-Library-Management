@section('title', 'Settings | Index')
<x-app-layout>
    <div class="py-12">
        <div class="container">
            <div class="row pb-5">
                <div class="col-6">
                    <h1 class="author-h1">Settings</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 flex align-middle justify-center">
                    <div class="card rounded" style="width: 30rem">
                        <div class="card-body">
                            <form action="{{ route('settings.update',$setting->id) }}" method="POST">
                                @csrf
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td style="width: 30%">Return Days: </td>
                                            <td>
                                                <input type="text" name="return_days" value="{{ $setting->return_days }}">    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Fine(per day): </td>
                                            <td>
                                                <input type="text" name="fine_per_day" id="" value="{{ $setting->fine_per_day }}">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="submit" class="btn btn-success"
                                                style="background-color: #28a745">Update</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

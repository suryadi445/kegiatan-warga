@extends('template.admin')

@section('container-admin')
    <x-toast></x-toast>

    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-center">Halaman Profile</h3>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <form action="{{ route('identity.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <tbody>
                            <tr>
                                <td>
                                    Logo
                                </td>
                                <td>
                                    <div class="mb-3">
                                        @if (!empty($identity->logo))
                                            <img src="{{ $identity->logo }}" alt="image" width="10%">
                                        @endif
                                        <input class="form-control mt-2" name="logo" type="file" id="formFile"
                                            value="{{ $identity->logo }}">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nama Profile
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <x-input placeholder="Input Nama Profile" tipe="nama_profile" attr="nama_profile"
                                            value="{{ $identity->nama_profile }}">
                                        </x-input>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Alamat
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <x-input placeholder="Input Alamat" tipe="alamat" attr="alamat"
                                            value="{{ $identity->alamat }}"></x-input>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Telepon
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <x-input placeholder="Input Nomor Telepon" tipe="telepon" attr="telepon"
                                            value="{{ $identity->telepon }}"></x-input>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Whatsapp
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <x-input placeholder="Input No Whatsapp" tipe="whatsapp" attr="whatsapp"
                                            value="{{ $identity->whatsapp }}"></x-input>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Slogan
                                </td>
                                <td>
                                    <div class="mb-3">
                                        <x-textarea height="100px" attr="slogan" value="{{ $identity->slogan }}">
                                        </x-textarea>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td colspan="2">
                                    <button type="submit" class="float-end btn btn-primary">Save Changes</button>
                                </td>
                            </tr>
                        </tbody>
                    </form>
                </table>
            </div>
        </div>
    </div>
@endsection

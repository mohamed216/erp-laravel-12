@extends('layout.app')
@section('title', 'Settings')
@section('content')
<div class="card">
    <div class="card-header"><h4>Settings</h4></div>
    <div class="card-body">
        <form method="POST" action="/settings">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Company Name</label>
                    <input name="company_name" value="{{ $settings['company_name'] }}" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input name="company_email" value="{{ $settings['company_email'] }}" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input name="company_phone" value="{{ $settings['company_phone'] }}" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Currency</label>
                    <select name="currency" class="form-control">
                        <option value="SAR" {{ $settings['currency'] == 'SAR' ? 'selected' : '' }}>SAR - Saudi Riyal</option>
                        <option value="USD" {{ $settings['currency'] == 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                        <option value="EUR" {{ $settings['currency'] == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                        <option value="EGP" {{ $settings['currency'] == 'EGP' ? 'selected' : '' }}>EGP - Egyptian Pound</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Tax Rate (%)</label>
                    <input name="tax_rate" type="number" value="{{ $settings['tax_rate'] }}" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>Low Stock Alert</label>
                    <input name="low_stock_alert" type="number" value="{{ $settings['low_stock_alert'] }}" class="form-control">
                </div>
                <div class="col-md-12 mb-3">
                    <label>Address</label>
                    <textarea name="company_address" class="form-control">{{ $settings['company_address'] }}</textarea>
                </div>
            </div>
            <button class="btn btn-primary">Save Settings</button>
        </form>
    </div>
</div>
@endsection

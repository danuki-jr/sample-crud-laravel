@extends('layouts.default')

@section('content')
    <main class="home-main">
        <h1>Sample CRUD</h1>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Product</th>
                                <th scope="col">Description</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="tbody">
                            @foreach ($products as $product)
                                <tr id="product-row-{{ $product->id }}">
                                    <th scope="row">{{ $product->id }}</th>
                                    <td id="product-name-{{$product->id}}">{{ $product->name }}</td>
                                    <td id="product-description-{{$product->id}}">{{ $product->description }}</td>
                                    <td>
                                        <button type="button" id="update-{{ $product->id }}" class="btn btn-primary update-product" style="margin-right: 1em;" data-toggle="modal" data-target="#update-modal">UPDATE</button>
                                        <button type="button" id="delete-{{ $product->id }}" class="btn btn-primary delete-product">DELETE</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <input type="text" id="name" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="Name" />
                </div>
                <div class="col-sm-2">
                    <input type="text" id="description" class="form-control" placeholder="Description" aria-label="Description" aria-describedby="Description" />
                </div>
                <div class="col-sm-2">
                    <button type="button" id="add" class="btn btn-primary">ADD</button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <input type="hidden" id="update-id" value="" />
                        <input type="text" id="update-name" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="Name" style="margin-bottom: 1em;"/>
                        <input type="text" id="update-description" class="form-control" placeholder="Description" aria-label="Description" aria-describedby="Description"/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="update-submit" class="btn btn-primary">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@stop

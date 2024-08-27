@extends('layouts.dashboard.admin', ['title' => 'Freezolar Refrigeração - Administração - Catálogo - Editar Categoria'])

@section('content')
<div class="bg-body-light">
    <div class="content content-full p-1">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2 pl-3">Editar Categoria</h1>
            <nav class="flex-sm-00-auto ml-sm-3 pr-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Site</li>
                    <li class="breadcrumb-item">Catálogo</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.catalogo.categorias.index') }}">Categorias</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="{{ route('dashboard.admin.site.catalogo.categorias.edit', $category->id) }}">Editar</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="content p-0">
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <!-- Form Labels on top - Default Style -->
                    <form class="mb-5" method="POST" action="{{ route('dashboard.admin.site.catalogo.categorias.update', $category->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="row justify-content-center">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="nome">Nome da Categoria: <small style="color:red">*</small></label>
                                    <input type="text" class="form-control" id="category" name="category" placeholder="Nome da Categoria..." value="{{$category->category}}" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="category_id">Essa categoria é uma sub categoria de: <small style="color:red">*</small></label>
                                    <select class="js-select2 form-control" id="master_category_id" name="master_category_id" style="width: 100%;" data-placeholder="Selecione a categoria na qual a categoria a ser cadastrada pertence">
                                        <option value="">Nenhuma Categoria</option>
                                        @foreach ($master_categorias as $master )
                                            <option value="{{$master->id}}" {{!is_null($category->parent_id) && $category->parent_id == $master->id ? 'selected' : ''}}>{{$master->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label for="description">Descrição</label>
                                    <textarea class="form-control form-control-alt" id="description" name="description" rows="5" placeholder="Descrição curta sobre o que será encontrado nessa categória...">{{$category->description}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

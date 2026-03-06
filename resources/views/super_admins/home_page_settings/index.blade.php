@extends('super_admins.layouts.master')

@section('title')
    {{ $heading }}
@endsection

@section('css')
    @include('super_admins.includes.datatable_css')
    <style>
        /* Add smooth transitions for list items */
        .list-group-item {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .dragging {
            opacity: 0.5;
            background-color: #f0f0f0;
            /* Slight highlight when dragging */
        }

        .drag-over {
            border: 2px dashed #007bff;
        }

        /* Add smooth placeholder effect */
        .placeholder {
            background-color: #f0f0f0;
            border: 2px dashed #007bff;
            height: 50px;
            /* Adjust placeholder size */
        }

        #sortable-list li {
            cursor: pointer;
        }

        #sortable-list li:focus {
            cursor: all-scroll;
        }

        #sortable-list li:active {
            cursor: all-scroll;
        }

        .dragging {
            cursor: all-scroll
        }

        .placeholder {
            cursor: all-scroll
        }
    </style>
@endsection


@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4 pt-4 pt-lg-0">
                <div class="col-sm-6">
                    <h2 class="main-content-title fw-bold mb-0">{{ $heading }}</h2>
                    <ol class="breadcrumb float-sm-left">
                        <li class="breadcrumb-item"><a href="{{ route('super_admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active"> {{ $heading }} </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row justify-content-center">
                        <div class="card w-50">
                            <div class="card-body">
                                <div class="card-body">
                                    <ul id="sortable-list" class="list-group">
                                        @foreach ($home_page_components as $component)
                                            <li class="list-group-item d-flex align-items-center justify-content-between  text-start"
                                                data-id="{{ $component->id }}" draggable="true">
                                                <div style="gap: 30px" class="d-flex align-items-center gap-2">
                                                    <i class="fa-solid fa-grip d-none d-md-block"></i>
                                                    {{-- ({{ $component->sort_order }}) --}}
                                                    {{ $component->display_name }}
                                                </div>
                                                <span class="">
                                                    @if ($component->is_active)
                                                        <i class="fa-solid fa-eye text-success d-none d-md-block toggle-visibility"
                                                            data-id="{{ $component->id }}" data-active="1"></i>
                                                    @else
                                                        <i class="fa-solid fa-eye-slash text-danger d-none d-md-block toggle-visibility"
                                                            data-id="{{ $component->id }}" data-active="0"></i>
                                                    @endif
                                                </span>
                                            </li>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                {{-- <div class="card-footer">
                                    <button id="save-order" class="btn btn-primary">Save Order</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const list = document.getElementById('sortable-list');
            let draggedItem = null;
            let placeholder = null;

            // Drag and Drop Handling
            list.addEventListener('dragstart', function(e) {
                draggedItem = e.target;
                draggedItem.classList.add('dragging');
            });

            list.addEventListener('dragover', function(e) {
                e.preventDefault();
                const afterElement = getDragAfterElement(list, e.clientY);
                if (afterElement == null) {
                    list.appendChild(draggedItem);
                } else {
                    list.insertBefore(draggedItem, afterElement);
                }

                if (placeholder) {
                    placeholder.classList.remove('placeholder');
                }

                const nextElement = getDragAfterElement(list, e.clientY);
                if (nextElement) {
                    nextElement.classList.add('placeholder');
                    placeholder = nextElement;
                }
            });

            list.addEventListener('dragend', function() {
                draggedItem.classList.remove('dragging');
                if (placeholder) {
                    placeholder.classList.remove('placeholder');
                }
                draggedItem = null;
                placeholder = null;
                saveOrder();
            });

            function getDragAfterElement(list, y) {
                const items = [...list.querySelectorAll('.list-group-item:not(.dragging)')];
                return items.reduce((closest, child) => {
                    const box = child.getBoundingClientRect();
                    const offset = y - box.top - box.height / 2;
                    if (offset < 0 && offset > closest.offset) {
                        return {
                            offset: offset,
                            element: child
                        };
                    } else {
                        return closest;
                    }
                }, {
                    offset: Number.NEGATIVE_INFINITY
                }).element;
            }

           
            function saveOrder() {
                const orderedItems = [...list.querySelectorAll('.list-group-item')];
                const order = orderedItems.map(item => item.dataset.id);

                $.ajax({
                    url: '{{ route('super_admin.home_page.update') }}',
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        order: order
                    },
                    success: function(response) {
                        console.log('Order saved successfully');
                        toastr.success('Sort Order saved successfully');
                    },
                    error: function(error) {
                        console.error('Error saving order:', error);
                        toastr.error('Error saving order');
                    }
                });
            }

    
            list.addEventListener('click', function(e) {
                if (e.target.classList.contains('toggle-visibility')) {
                    const icon = e.target;
                    const id = icon.dataset.id;
                    const isActive = icon.dataset.active === "1";
                    $.ajax({
                        url: '{{ route('super_admin.home_page.status') }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id,
                            is_active: isActive ? 0 : 1
                        },
                        success: function(response) {

                            if (isActive) {
                                icon.classList.remove('fa-eye', 'text-success');
                                icon.classList.add('fa-eye-slash', 'text-danger');
                                icon.dataset.active = "0";
                            } else {
                                icon.classList.remove('fa-eye-slash', 'text-danger');
                                icon.classList.add('fa-eye', 'text-success');
                                icon.dataset.active = "1";
                            }

                            toastr.success(response.message ||
                                'Visibility updated successfully');
                        },
                        error: function(error) {
                            console.error('Error toggling visibility:', error);
                            toastr.error('Error updating visibility');
                        }
                    });
                }
            });
        });
    </script>
@endsection

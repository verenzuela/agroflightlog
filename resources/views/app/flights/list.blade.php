@component('layouts.app.base')
    @slot('title') My Flights @endslot
    @slot('metaDescription')
    @slot('metaKeywords')

    @slot('h1Title') My Flights @endslot

    @slot('breadcrumbFaIcon') fa-list @endslot
    @slot('breadcrumbParent') Flights @endslot
    @slot('breadcrumbParentlink')  @endslot
    @slot('breadcrumbChild') List @endslot

    @slot('styles')
    <style>
        
    </style>
    @endslot

    @slot('scripts')

    @section('app-content')
    
    <!-- Main content -->
    <section class="content">
        
        <div class="table-responsive">
            <table class="table">
                
            </table>
        </div>

    </section>
    @endsection
@endcomponent
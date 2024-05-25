<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News</title>
    <link href="/css/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/jquery-ui.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>

<body>
    <div class="row col-15">
        <form action="{{route('news.list')}}" class="form">
            <div class="row col-15">
                <div class="col-md-2 m-3">
                    <input type="text" name="search" class="form-control" value="{{ $q ? $q : '' }}" />
                </div>
                <div class="col-md-2 m-3 form-group">
                    <select class="form-select" id="" name="sort_by">
                        @foreach($sortBy as $sort)
                        <option value="{{$sort}}" {{ request()->sort_by == $sort ? 'selected' : ''}}>{{$sort}}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 m-3">
                    <input type="text" id="datepicker" class="form-control" placeholder="Select date"
                        name="published_date" value="{{ $from ? $from : '' }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn-md m-3 btn btn-success">Search</button>
                    <a href="{{route('news.list')}}" class="btn-md m-3 btn btn-primary">Reset</a>
                </div>
            </div>
        </form>
        <div class="row col-10">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Title</th>
                        <th scope="col" class="px-6 py-3">Source</th>
                        <th scope="col" class="px-6 py-3">Author</th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3">Published At</th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $value)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-6 py-4">
                            {{ $value->title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $value->source->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $value->author }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $value->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ date('Y-m-d',strtotime($value->publishedAt)) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="px-6 py-4" colspan="5" style="text-align: center;">No Record found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script>
    $(function() {
        $('#datepicker').datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
    </script>
    <script src="/js/flowbite.min.js"></script>
</body>

</html>
<h1>Add Degree or Certificate</h1>
<form class="mb-3" method="POST" action="{{ route('/education/create-certificate-diploma') }}">
    @csrf

    <input class="form-control" id="education_id" value="{{$education->id}}" name="education_id" type="hidden"/>

    <div class="form-row">

        <div class="col">
            <div class="form-group">
                <label for="degree_or_certificate">Degree or Certificate</label>
                <select class="form-control" id="degree_or_certificate" name="degree_or_certificate">
                    <option selected>Choose Degree or Certificate</option>
                    <option value="degree">Degree</option>
                    <option value="certificate">Certificate</option>
                </select>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="major">Major</label>
                <input class="form-control" id="major" name="major" type="text"/>
            </div>
        </div>

    </div>

    <div class="form-row">

        <div class="col">
            <div class="form-group">
                <label for="gpa">GPA</label>
                <input class="form-control" id="gpa" name="gpa" step="0.01" value="0.00" placeholder="0.00" type="number"/>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="completed_month_year">Completion Month & Year</label>
                <input class="form-control" id="completed_month_year_preformat" name="completed_month_year_preformat" type="month"/>
            </div>
        </div>

    </div>

    <div class="form-group">
        <label for="honors_info">Honors Info</label>
        <textarea class="form-control" id="honors_info" name="honors_info"></textarea>
    </div>

    <button class="btn btn-lg btn-primary text-center" type="submit">Create Degree or Certificate</button>

    <a class="btn btn-lg btn-success" href="/education"><i class="fas fa-user-graduate"></i> Back to Education</a>

</form>

<div>
  <form>
    <label for="input-by-year">Enter a year:</label>
    <input type="text" name="year" id="input-by-year"
           value="<?php echo $sf_request->hasParameter('year') ? $sf_request->getParameter('year') : '' ?>" />
    <input type="submit" value="Submit" />
  </form>
</div>

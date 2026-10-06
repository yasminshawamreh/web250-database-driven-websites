<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once('../private/initialize.php');
  $page_title = 'Sightings';
?>

<?php
/*
 * birds.php -- STARTER SCAFFOLD
 *
 * Read the whole file before you write anything. Note that the page logic
 * (loading and preparing data) happens up here, ABOVE the header include,
 * and the markup happens below it. Keeping those separate is why you can
 * print a clean error message instead of a half-rendered page.
 *
 * Your model is public/bicycles.php from chapter 7 video 07.
 */

/*
 * TODO 1 -- The delimiter
 *
 * Open private/wnc-birds.csv. The fields are not separated by commas.
 *
 * ParseCSV ships with a comma as its default and you must not edit that
 * file. Instead, set the delimiter from out here, before you parse, using
 * the static property. One line.
 *
 * WHEN YOU SKIP THIS STEP: the page still loads and the table still has one
 * row per bird, but every cell is empty. That is the symptom to remember.
 * The whole line lands in a single field, so the key your constructor looks
 * for never exists and every property falls back to its default.
 *
 * why comment required: why can you set this from outside the class at all,
 * and why is that better than editing parsecsv.class.php?
 */

 // The delimiter can be changed from outside the class because ParseCSV exposes it as a public static property.
// Setting it here lets the same parser handle this CSV without changing the reusable ParseCSV class.
ParseCSV::$delimiter = '|';


/*
 * TODO 2 -- Parse the file
 *
 * Create a ParseCSV object for PRIVATE_PATH . '/wnc-birds.csv' and call
 * parse(). Build the path from the constant, not a relative path like
 * '../private/wnc-birds.csv'.
 */
$parser = new ParseCSV(PRIVATE_PATH . '/wnc-birds.csv');
$bird_data = $parser->parse();


/*
 * TODO 3 -- Handle a missing or unreadable file
 *
 * parse() returns false when there was no readable file. If you hand false
 * to a foreach, PHP warns and you get a blank page with a warning on it.
 *
 * Set a flag here (something like $data_error) and use it further down to
 * print a readable message instead of the table. The page must still render
 * its header, nav, and footer. Test it by renaming the CSV, loading the
 * page, and then renaming it back.
 */
$data_error = ($bird_data === false);


/*
 * TODO 4 -- Build the objects
 *
 * Loop over the parsed rows and create one Bird per row, collecting them in
 * an array. In bicycles.php this happens inside the table markup; do it up
 * here instead so the markup below stays readable.
 */
$birds = [];

if(!$data_error) {
  foreach($bird_data as $args) {
    $birds[] = new Bird($args);
  }
}


/*
 * OPTIONAL -- "go further" options 1 and 2 (sort and filter)
 *
 * If you are doing those, this is where the $_GET handling goes. Validate
 * anything that arrives in the query string against a list of values you
 * control BEFORE you use it. Explain in a comment why you cannot trust $_GET
 * directly.
 */

?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<h2>Bird inventory</h2>
<p>This is a short list -- start your birding!</p>


<?php /* TODO 5 -- if you set an error flag in TODO 3, print the message here
         and skip the table. */ ?>
<?php if($data_error) { ?>

<p>Sorry, the bird data could not be loaded.</p>
<?php } else { ?>

<?php
/*
 * TODO 6 -- The record count
 *
 * Print a line reporting how many records were in the file, using the
 * row_count() method. If you added the static counter to Bird, print that
 * too. Notice whether the two numbers agree.
 */

?>

<p>CSV records: <?php echo h($parser->row_count()); ?></p>
<p>Bird objects: <?php echo h(Bird::$count); ?></p>


<?php
/*
 * TODO 7 -- The table
 *
 * Build it with <thead> and <tbody>, a <caption>, and scope="col" on each
 * header cell. Use border="1" so it is readable without CSS. The page has to
 * validate at validator.w3.org, so no stray tags.
 *
 * A column for each thing worth showing. The measurements should appear in
 * both units, the way bicycles.php shows kg and lbs:
 *
 *   Bird (common name, and the scientific name in <em>)
 *   Habitat, Food, Nest, Behavior
 *   Wingspan (cm / in)
 *   Weight (g / oz)
 *   Size class
 *   Conservation
 *   Backyard tips
 *
 * TODO 8 -- The rows
 *
 * foreach over your array of Bird objects and emit one <tr> per bird.
 *
 * EVERY value goes through h(). No exceptions. The backyard_tips column
 * contains apostrophes and dashes typed by a human, which is exactly the
 * kind of content that breaks a page when it is not escaped.
 *
 * Call your methods, not the raw properties, for anything measured or coded:
 * $bird->wingspan_cm() rather than reaching for the property.
 */
?>


<table border="1">
  <caption>WNC Birds</caption>

  <thead>
  <tr>
    <th scope="col">Bird</th>
    <th scope="col">Habitat</th>
    <th scope="col">Food</th>
    <th scope="col">Nest</th>
    <th scope="col">Behavior</th>
    <th scope="col">Wingspan (cm / in)</th>
    <th scope="col">Weight (g / oz)</th>
    <th scope="col">Size class</th>
    <th scope="col">Conservation</th>
    <th scope="col">Backyard tips</th>
  </tr>
</thead>

<tbody>
  <?php foreach($birds as $bird) { ?>
    <tr>
      <td>
        <?php echo h($bird->common_name); ?> -
        <em><?php echo h($bird->scientific_name); ?></em>
      </td>
      <td><?php echo h($bird->habitat); ?></td>
      <td><?php echo h($bird->food); ?></td>
      <td><?php echo h($bird->nest_placement); ?></td>
      <td><?php echo h($bird->behavior); ?></td>
      <td>
        <?php echo h($bird->wingspan_cm()); ?> /
        <?php echo h($bird->wingspan_in()); ?>
      </td>
      <td>
        <?php echo h($bird->weight_g()); ?> /
        <?php echo h($bird->weight_oz()); ?>
      </td>
      <td><?php echo h($bird->size_class()); ?></td>
      <td><?php echo h($bird->conservation()); ?></td>
      <td><?php echo h($bird->backyard_tips); ?></td>
    </tr>
  <?php } ?>
</tbody>
</table>

<?php } ?>
<?php include(SHARED_PATH . '/public_footer.php'); ?>

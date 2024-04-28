<?php

function printJob($dataModel) {
    echo '<div class="job">';
        echo '<h2>' . $dataModel->title . '</h2>';
        echo '<div class="company-location"><div class="company">' . $dataModel->company . '</div>';
        echo '<div class="location">' . $dataModel->location . ' - ' . $dataModel->workplaceTypes . '</div></div>';
        echo '<div class="application-link"><a href="' . $dataModel->applyUrl . '">Simple application</a></div>';
        echo '<div class="detail">';
            echo '<a class="detail-anchor" href="#">';
                echo '<span class="detail-indicator">+ Show details</span>';
                echo '<span class="detail-indicator hidden">&times; Close details</span>';
            echo '</a>';
            echo '<div class="detail-content hidden">';
                echo '<div class="description">';
                    echo '<h3>Job description</h3>';
                    echo '<p>' . $dataModel->description . '</p>';
                echo '</div>';
                echo '<div class="information">';
                    echo '<h3>Job information</h3>';
                    echo '<table class="job-information">';
                        echo '<tr>';
                            echo '<td>Job type</td>';
                            echo '<td>' . $dataModel->jobType . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>Experience level </td>';
                            echo '<td>' . $dataModel->experienceLevel. '</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>Job functions</td>';
                            echo '<td>' . implode(', ', $dataModel->jobFunctions) . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>Skills</td>';
                            echo '<td>' . implode(', ', $dataModel->skills) . '</td>';
                        echo '</tr>';
                        echo '<tr>';
                            echo '<td>Salary range</td>';
                            echo '<td>' . $dataModel->minSalary . ' - ' . $dataModel->maxSalary . '</td>';
                        echo '</tr>';
                    echo '</table>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
}
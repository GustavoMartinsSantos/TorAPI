<?php
    class Pagination {
        private $numResults;
        private $numPages;
        private $limit;
        
        // get the first index of the array at the current page
        public function getOffset ($currentPage) {
            return ($currentPage - 1) * $this->limit;
        }

        public function setNumPages () {
            $this->numPages = ($this->numResults > 0) ? ceil($this->numResults / $this->limit) : 1;
        }

        public function getResults ($results, $currentPage = 1) {
            $currentPage = (filter_var($currentPage, FILTER_VALIDATE_INT) && $currentPage > 0) ? $currentPage : 1;
            $currentPage = $currentPage > $this->numPages ? $this->numPages : $currentPage;
            // if current page exceeds the number of pages returns the last page

            return array_slice($results, $this->getOffset($currentPage), $this->limit);
        }

        // returns < 1 2 3 ... 298 >
        public function getButtonsSection ($currentPage = 1, $numButtonsPerSection = 3, $buttonColor = '#212529', $textColor = "white", $currentPageButtonColor = '#40F128') {
            if($this->numPages == 1)
                return null;

            // first link
            $section = "<nav>
                          <ul class='pagination'>
                            <li class='page-item'> 
                              <a class='page-link' style='background-color: {$buttonColor}; color: $textColor;' href='?page=1' aria-label='Primeira'>
                                <span class='sr-only'>Primeira</span>
                              </a>
                            </li>";

            $numButtonsPerSection = floor($numButtonsPerSection/2);
            // current page link is always at the middle

            // get all previous links
            for($previousPage = $currentPage - $numButtonsPerSection; $previousPage <= $currentPage - 1; $previousPage++) {                
                if($previousPage >= 1)
                    $section .= "<li class='page-item'><a class='page-link' style='background-color: {$buttonColor}; color: $textColor;' href='?page={$previousPage}'>{$previousPage}</a></li>";
            }

            $section .= "<li class='page-item'><a class='page-link' style='background-color: {$currentPageButtonColor}; color: rgb(0,0,0);' href='?page={$currentPage}'>{$currentPage}</a></li>";

            // get all next links
            for($nextPage = $currentPage + 1; $nextPage <= $currentPage + $numButtonsPerSection; $nextPage++) {
                if($nextPage <= $this->numPages)
                    $section .= "<li class='page-item'><a class='page-link' style='background-color: {$buttonColor}; color: $textColor;'href='?page={$nextPage}'>{$nextPage}</a></li>";
            }

            // last page link
            $section .= "<li class='page-item'>
                            <a class='page-link' style='background-color: {$buttonColor}; color: $textColor;' href='?page={$this->numPages}' aria-label='Última'>
                                <span class='sr-only'>Última</span>
                            </a>
                        </li>
                    </ul>
                </nav>";

            return $section;
        }

        public function __construct($numResults, $limit = 54) {
            $this->numResults = $numResults;
            $this->limit = $limit;
            $this->setNumPages();
        }
    }
?>